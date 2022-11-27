<?php
namespace App\Http\Services;

use App\Http\Interfaces\ServerData;
use App\Models\Server;
use App\Models\ServerOnline;
use App\Models\ServerViews;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class ServerStats
{
    /**
     *
     * Получение рейтинга проекта и места в топе игры
     *
     * @param $gameID
     * @param $serverID
     * @return Collection
     */
    public static function getServerRating($gameID, $serverID): Collection
    {
        $servers =
            Server::with(["game"])
                ->whereHas("game",  function($q) use ($gameID) {
                    $q->where("games.id", $gameID);
                })
                ->selectRaw("`servers`.*,(select count(*) from `server_rates` where `servers`.`id` = `server_rates`.`server_id`) * ".ServerData::coefficient." + IFNULL((select rating from `server_ratings` where `servers`.`id` = `server_ratings`.`server_id`), 0) as `rating`")
                ->orderByDesc("rating")
                ->get();

        $serverKey = $servers->search(function ($item) use ($serverID) {
            return $item['id'] == $serverID;
        });

        $server = $servers[$serverKey];

        return collect([
            "place" => $serverKey + 1,
            "rating" => $server->rating,
        ]);
    }

    /**
     *
     * Получение онлайна проекта за последний месяц
     *
     * @param $serverID
     * @return Collection
     */
    public static function getServerOnline($serverID): Collection {
        return ServerOnline::where("server_id", $serverID)
            ->where("created_at", ">=", Carbon::now()->subMonth()->toDateTimeString())
            ->orderBy("created_at")
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('d.m');
            });
    }

    /**
     *
     * Подсчёт среднего кол-ва онлайна за месяц
     *
     * @param $serverID
     * @return int
     */
    public static function getServerOnlineAvg($serverID): int {
        return ServerOnline::where("server_id", $serverID)->where("created_at", ">=", Carbon::now()->subMonth()->toDateTimeString())->get()->avg('online') ?? 0;
    }

    /**
     *
     * Регистрация просмотра сервера
     *
     * @param $serverID
     */
    public static function registerServerView($serverID): void {
        if ($uid = Cookie::get('visitor_uid')) { // Если в куках пользак уже зареган, то:
            if(ServerViews::where('visitor_uuid', $uid)->where('server_id', $serverID)->doesntExist()){ // проверяем, просматривал ли он сервер
                ServerViews::create(['visitor_uuid' => $uid, "server_id" => $serverID]);
            }
        } else { // если пользак не зареган, то регистрируем и добавляем в счётчик значение
            $uid = Str::uuid();
            Cookie::queue('visitor_uid', $uid);
            ServerViews::create(['visitor_uuid' => $uid, "server_id" => $serverID]);
        }
    }

    public static function getServerViews($serverID): int {
        return ServerViews::where("server_id", $serverID)->count();
    }
}
