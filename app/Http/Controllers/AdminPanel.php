<?php

namespace App\Http\Controllers;

use Alexusmai\YandexMetrika\YandexMetrika;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminPanel extends Controller
{
    /**
     * @var YandexMetrika объект яндекс метрики
     */
    private $metric;

    /**
     * AdminPanel constructor.
     */
    public function __construct()
    {
        $this->middleware('admin');
        $this->metric = new YandexMetrika;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $statistic = $this->getViewsData();
        $page_views = $this->getTopPageViews();
        $refusal = $this->getRefusal();

        $name = Auth::user()->name. " " . Auth::user()->surname;

        $this->getRefusal();

        return view(
            'admin.home',
            compact(
                "name",
                "page_views",
                "statistic",
                "refusal"
            )
        );
    }

    /**
     *
     * Получение массива просматриваемых страниц
     *
     * @return array|null
     */
    private function getTopPageViews(): ?array {
        $this->metric->getTopPageViews()->adapt();
        return $this->metric->adaptData;
    }

    private function getRefusal(): ?array {
        $urlParams = [
            'ids'           => config('yandex-metrika.counter_id'),                        //id счетчика
            'date1'         => "7daysAgo",    //Начальная дата
            'date2'         => "today",                 //Конечная дата
            'metrics'       => 'ym:s:bounceRate'
        ];

        $refusal = round($this->metric->getRequestToApi($urlParams)->data["totals"][0], 2);

        $urlParams["date1"] = "14daysAgo"; $urlParams["date2"] = "7daysAgo";
        $refusal_prev_days =round( $this->metric->getRequestToApi($urlParams)->data["totals"][0], 2);

        $refusal_percent = round(($refusal - $refusal_prev_days) / $refusal_prev_days, 2);

        return [
            "data" => $refusal, // Отказы, %
            "percent" => $refusal_percent // процент разницы отказов по сравнению с предыдущей неделей
        ];
    }

    /**
     *
     * Подсчет уникальных пользователей и визитов
     *
     * @return array|null
     * @throws \Exception
     */
    private function getViewsData() : ?array {
        $this->metric->getVisitsViewsUsers()->adapt();

        $dataArray = json_decode($this->metric->adaptData["dataArray"]);
        $date = json_decode($this->metric->adaptData["dateArray"]);

        $this->metric->getVisitsViewsUsersForPeriod(new \DateTime(date("Y-m-d H:i:s", time() - 5259486)), new \DateTime(date("Y-m-d H:i:s", time() - 2629743)))->adapt(); //За указанный период

        $dataArray_prev_month = json_decode($this->metric->adaptData["dataArray"]);

        $visits = $users = array();

        $visits_prev_month = $users_prev_month = array();

        for ($i = 0; $i < count($dataArray[0]->data); $i++){
            array_push($visits, ["data" => $dataArray[0]->data[$i], "date" => $date[$i]]);
            array_push($users, ["data" => $dataArray[2]->data[$i], "date" => $date[$i]]);
        }

        for ($i = 0; $i < count($dataArray_prev_month[0]->data); $i++){
            array_push($visits_prev_month, ["data" => $dataArray_prev_month[0]->data[$i]]);
            array_push($users_prev_month, ["data" => $dataArray_prev_month[2]->data[$i]]);
        }

        $visits_sum = array_sum(array_column($visits, 'data'));;
        $users_sum = array_sum(array_column($users, 'data'));
        $visits_sum_prev_month = array_sum(array_column($visits_prev_month, 'data'));
        $users_sum_prev_month = array_sum(array_column($users_prev_month, 'data'));

        $visits_percent = round(($visits_sum - $visits_sum_prev_month) / $visits_sum_prev_month * 100, 2);
        $users_percent = round(($users_sum - $users_sum_prev_month) / $users_sum_prev_month * 100, 2);

        return [
            "visits" => $visits, // массив визитов по дням за последние 30 дней
            "users" => $users, // массив пользвоателей по дням за последние 30 дней
            "visits_sum" => $visits_sum, // сумма визитов за 30 дней
            "users_sum" => $users_sum, // сумма уникальных пользователей за 30 дней
            "visits_percent" => $visits_percent, // процент разницы визитов по сравнению с предыдущим месяцем
            "users_percent" => $users_percent, // процент разницы уникальных пользователей по сравнению с предыдущим месяцем
        ];
    }
}
