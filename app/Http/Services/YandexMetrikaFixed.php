<?php


namespace App\Http\Services;


use Alexusmai\YandexMetrika\DataPreparation;
use Alexusmai\YandexMetrika\YandexMetrika;
use Carbon\Carbon;
use DateTime;

class YandexMetrikaFixed extends YandexMetrika
{
    use DataPreparation;

    protected function getVisitsViewsUsersForPeriod(
        DateTime $startDate,
        DateTime $endDate
    ){
        $cacheName = md5(serialize('visits-views-users'
            .$startDate->format('Y-m-d').$endDate->format('Y-m-d')));

        $urlParams = [
            'ids'        => $this->counter_id,
            'date1'      => $startDate->format('Y-m-d'),
            'date2'      => $endDate->format('Y-m-d'),
            'metrics'    => 'ym:s:visits,ym:s:pageviews,ym:s:users',
            'dimensions' => 'ym:s:date',
            'sort'       => 'ym:s:date',
        ];

        $this->data = $this->request($urlParams, $cacheName);
    }

    /**
     * Данные для графика Highcharts › Basic line
     */
    protected function adaptVisitsViewsUsers()
    {
        //Формируем массив данных для графика
        $itemArray = [
            'date' => [],
            'visits' => [],
            'pageviews' => [],
            'users' => []
        ];

        foreach ($this->data['data'] as $item) {
            array_push($itemArray['date'], Carbon::createFromFormat('Y-m-d',
                $item['dimensions'][0]['name'])->formatLocalized('%e.%m'));
            array_push($itemArray['visits'], $item['metrics'][0]);
            array_push($itemArray['pageviews'], $item['metrics'][1]);
            array_push($itemArray['users'], $item['metrics'][2]);
        }

        $dataArray = [
            ['name' => 'Визиты', 'data' => $itemArray['visits']],
            ['name' => 'Просмотры', 'data' => $itemArray['pageviews']],
            ['name' => 'Посетители', 'data' => $itemArray['users']],
        ];

        $this->adaptData = [
            'dataArray' => json_encode($dataArray, JSON_UNESCAPED_UNICODE),
            'dateArray' => json_encode($itemArray['date'],
                JSON_UNESCAPED_UNICODE),
        ];
    }
}
