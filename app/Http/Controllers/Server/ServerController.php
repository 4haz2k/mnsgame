<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\PaymentTypes;
use App\Http\Interfaces\ServerData;
use App\Http\Requests\EditServerRequest;
use App\Http\Requests\StoreServer;
use App\Http\Services\ImageService;
use App\Http\Services\MNSGameSEO;
use App\Http\Services\ServerStats;
use App\Models\FavoriteServers;
use App\Models\Filter;
use App\Models\FilterOfServer;
use App\Models\Game;
use App\Models\PaymentHistory;
use App\Models\Server;
use App\Models\ServerOnline;
use App\Models\ServerRconHistory;
use Artesaos\SEOTools\Traits\SEOTools;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ServerController extends Controller
{
    use MNSGameSEO;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $games = Game::all();
        return view("account.addserver", compact("games"));
    }

    /**
     * @param StoreServer $request
     * @return RedirectResponse
     */
    public function createServer(StoreServer $request): RedirectResponse
    {
        $game_id = Game::where("title", \request("game_title"))->firstOrFail()->id;
        $is_launcher = \request("is_launcher");

        if($is_launcher == null)
            if(\request("server_ip") == null) {
                $server_data = \request("launcher_link");
                $is_launcher = "on";
            }
            else
                $server_data = \request("server_ip");
        else
            $server_data = \request("launcher_link");

        $image = new ImageService();

        $server = new Server();
        $server->title = \request("server_title");
        $server->description = strip_tags(\request("server_description"), '\n');
        $server->is_launcher = $is_launcher != null;
        $server->server_data = $server_data;
        $server->banner_img = $image->handleUploadedImage($request);
        $server->callback = \request("server_callback");
        $server->site = \request("server_site");
        $server->vk = \request("server_vk");
        $server->discord = \request("server_discord");
        $server->game_id = $game_id;
        $server->owner_id = Auth::id();
        $server->hash = Str::random(30);
        $server->save();

        if(\request("filters_input") != null){
            $filters_id = Filter::with(["game"])
                ->whereIn("id", json_decode(\request("filters_input")))
                ->whereHas("game", function ($q) use ($game_id){
                    $q->where("id", $game_id);
                })
                ->get()
                ->pluck("id");

            $filters_of_server_array = [];

            foreach ($filters_id as $filter_id) {
                array_push($filters_of_server_array, [
                    "filter_id" => $filter_id,
                    "server_id" => $server->id,
                ]);
            }

            if(count($filters_of_server_array ) !== 0){
                FilterOfServer::insert($filters_of_server_array);
            }
        }

        return Redirect::route("myservers");
    }

    public function editServer(Request $request){
        $games = Game::all();
        $server = Server::with(["game", "filters"])->where("id", $request->id)->where("owner_id", Auth::id())->selectRaw("`servers`.*,(select count(*) from `server_rates` where `servers`.`id` = `server_rates`.`server_id`) * ".ServerData::coefficient." + IFNULL((select rating from `server_ratings` where `servers`.`id` = `server_ratings`.`server_id`), 0) as `rating`")->firstOrFail();
        $bg_type = $this->checkDonate($server->id);
        $filters_suggestion = Filter::whereHas("game", function ($q) use ($server) { $q->where("id", $server->game->id); })->get();
        return view('account.editserver', compact("server", "games", "filters_suggestion", "bg_type"));
    }

    /**
     *
     * Проверка списка услуг
     *
     * @param $server_id
     * @return string|null
     */
    private function checkDonate($server_id): ?string
    {
        $payment = PaymentHistory::where("server_id", $server_id)->where("is_active", false)->get();

        if($payment->isEmpty()){
            return null;
        }

        if($payment->contains('type', PaymentTypes::PACKET_SAPPHIRE["title"]) or $payment->contains('type', PaymentTypes::PACKET_EMERALD["title"])){
            return "bg-gr";
        } elseif($payment->contains('type', PaymentTypes::PACKET_RUBY["title"])){
            return "bg-cl";
        } else{
            return null;
        }
    }

    /**
     *
     * Сохранение сервера
     *
     * @param EditServerRequest $request
     * @return RedirectResponse
     */
    public function saveServer(EditServerRequest $request): RedirectResponse
    {
        $server = Server::where("id", $request->get("server_id"))->where("owner_id", Auth::id())->firstOrFail();
        $game = Game::where("title", $request->get("game_title"))->firstOrfail();

        if($request->has("server_title") and $request->filled('server_title'))
            if($request->server_title != $server->title)
                $server->title = $request->server_title;

        if($request->has("server_description") and $request->filled('server_description'))
            if($request->server_description != $server->description)
                $server->description = strip_tags($request->server_description, '\n');

        if($request->has("game_title") and $request->filled('game_title'))
            $server->game_id = $game->id;

        if($request->has("server_vk") and $request->filled('server_vk'))
            if($request->server_vk != $server->vk)
                $server->vk = $request->server_vk;

        if($request->has("server_discord") and $request->filled('server_discord'))
            if($request->server_discord != $server->discord)
                $server->discord = $request->server_discord;

        $server->is_launcher = $request->is_launcher;

        if($request->is_launcher)
            $server->server_data = $request->launcher_link;
        else
            $server->server_data = $request->server_ip;

        if($request->has("server_callback") and $request->filled('server_callback'))
            if($request->server_callback != $server->callback)
                $server->callback = $request->server_callback;

        if($request->hasFile("server_banner")){
            $image = new ImageService();
            $server->banner_img = $image->handleUploadedImage($request);
        }

        if($request->has("server_bg_color")){
            $bg_type = $this->checkDonate($server->id);
            $bg = $this->getServerBackground($bg_type, $request->server_bg_color);
            $server->background = $bg;
        }

        $server->save();

        FilterOfServer::where("server_id", $server->id)->delete();

        if(\request("filters_input") != null){
            $game_id = $game->id;

            $filters_id = Filter::with(["game"])
                ->whereIn("id", json_decode(\request("filters_input")))
                ->whereHas("game", function ($q) use ($game_id){
                    $q->where("id", $game_id);
                })
                ->get()
                ->pluck("id");

            $filters_of_server_array = [];

            foreach ($filters_id as $filter_id) {
                array_push($filters_of_server_array, [
                    "filter_id" => $filter_id,
                    "server_id" => $server->id,
                ]);
            }

            if(count($filters_of_server_array ) !== 0){
                FilterOfServer::insert($filters_of_server_array);
            }
        }

        return redirect()->route("myservers");
    }

    /**
     *
     * Смена заднего фона сервера
     *
     * @param $bg_type
     * @param $server_bg_color
     * @return null
     */
    private function getServerBackground($bg_type, $server_bg_color): ?string
    {
        if($bg_type){
            if($bg_type == "bg-cl"){
                switch ($server_bg_color){
                    case "color_clear":
                        $bg = null;
                        break;
                    case "color_red":
                        $bg = "server-bg-color-1";
                        break;
                    case "color_orange":
                        $bg = "server-bg-color-2";
                        break;
                    case "color_green":
                        $bg = "server-bg-color-3";
                        break;
                }
            }
            elseif ($bg_type == "bg-gr"){
                switch ($server_bg_color){
                    case "color_clear":
                        $bg = null;
                        break;
                    case "color_red":
                        $bg = "server-bg-color-1";
                        break;
                    case "color_orange":
                        $bg = "server-bg-color-2";
                        break;
                    case "color_green":
                        $bg = "server-bg-color-3";
                        break;
                    case "color_gr_blueRed":
                        $bg = "server-bg-gr-1";
                        break;
                    case "color_gr_greenBlue":
                        $bg = "server-bg-gr-2";
                        break;
                    case "color_gr_pinkOrange":
                        $bg = "server-bg-gr-3";
                        break;
                }
            }
            return $bg;
        }
        else{
            return null;
        }
    }

    public function myServers(){
        $games = Game::with(["servers" => function ($query){
            $query->selectRaw("*, (select count(*) from `server_rates` where `servers`.`id` = `server_rates`.`server_id`) * ".ServerData::coefficient." + IFNULL((select rating from `server_ratings` where `servers`.`id` = `server_ratings`.`server_id`), 0) as `rating`")->where("owner_id", Auth::id());
        }])
            ->get();

        foreach ($games as $key => $game){
            if($game->servers->isEmpty()){
                unset($games[$key]);
            }
        }

        return view('account.myservers', compact("games"));
    }

    public function getServerPage($id){
        $server = Server::where("id", $id)->with(["game", "filters"])
            ->selectRaw("`servers`.*,(select count(*) from `server_rates` where `servers`.`id` = `server_rates`.`server_id`) * ".ServerData::coefficient." + IFNULL((select rating from `server_ratings` where `servers`.`id` = `server_ratings`.`server_id`), 0) as `rating`")
            ->firstOrFail();

        if($server->chart)
            $server_online = ServerOnline::where("server_id", $server->id)
                ->where("created_at", ">=", Carbon::now()->subMonth()->toDateTimeString())
                ->orderBy("created_at")
                ->get()
                ->groupBy(function($date) {
                    return Carbon::parse($date->created_at)->format('d.m');
                });
        else
            $server_online = null;

        $game_id = $server->game->id;

        $randomFilters = Filter::whereHas("game", function ($q) use ($game_id) { $q->where("id", $game_id); })
            ->inRandomOrder()
            ->limit(5)
            ->get();

        $this->setPageSEO(false, false, [
            "description" => "Описание сервера $server->title: " . $server->description,
            "opengraph" => [
                "title" => $server->title . " - MNS Game Мониторинг",
                "description" => "Проект '". $server->title ."' по игре ".$server->game->title." на MNS Game Мониторинг",
                "url" => url("/server")."/".$server->id,
                "image" => asset($server->banner_img == null ? asset("/img/test/banner.png") : asset("/img/banners/{$server->banner_img}")),
                "type" => "article"
            ],
            "keywords" => ["сервера", "мониторинг серверов", $server->game->title, $server->game->short_link, $server->title, "ip адреса", "айпи серверов", "топ", "список", "рейтинг", "рейтинг серверов"]
        ]);

        ServerStats::registerServerView($id);

        return view("server", compact("server", "server_online", "randomFilters"));
    }

    public function serverStats($id) {
        $server = Server::with("serverRcon")->where("id", $id)->where("owner_id", Auth::id())->firstOrFail();

        $server_online = ServerStats::getServerOnline($server->id);
        $serverRating = ServerStats::getServerRating($server->game_id, $server->id);
        $serverOnlineAvg = ServerStats::getServerOnlineAvg($server->id);
        $serverViews = ServerStats::getServerViews($server->id);
        $connectionInfo = collect([
            "isConnected" => false,
            "isServerRegistered" => false,
            "history" => false,
        ]);

        if($serverConnection = $server->serverRcon) {
            $connectionInfo['isServerRegistered'] = true;
            if($serverConnection->is_connected) {
                if($key = Cookie::get("user_key")) {
                    if(($timeLeft = Carbon::parse($serverConnection->activated_time, "Europe/Moscow")->unix() - Carbon::now("Europe/Moscow")->unix()) > 0) {
                        $connectionInfo['isConnected'] = true;
                        $connectionInfo['isServerRegistered'] = true;
                        $connectionInfo['timeLeft'] = $timeLeft;
                        $connectionInfo['history'] = ServerRconHistory::where("server_id", $server->id)->where("deleted", false)->orderBy("created_at")->get();
                    } else {
                        ServerRconHistory::where("server_id", $server->id)->update(["deleted" => true]);
                        $serverConnection->is_connected = false;
                        $serverConnection->save();
                    }
                } else {
                    ServerRconHistory::where("server_id", $server->id)->update(["deleted" => true]);
                }
            }
        }

        return view("account.serverStats", compact(
            "server", "server_online", "serverRating",
            "serverOnlineAvg", "serverViews", "connectionInfo")
        );
    }

    public function favoriteServers() {
        $favoriteServers = FavoriteServers::where("user_id", Auth::id())->pluck("server_id");

        $games = Game::with(["servers" => function ($query) use ($favoriteServers){
            $query
                ->selectRaw("*, (select count(*) from `server_rates` where `servers`.`id` = `server_rates`.`server_id`) * ".ServerData::coefficient." + IFNULL((select rating from `server_ratings` where `servers`.`id` = `server_ratings`.`server_id`), 0) as `rating`")
                ->whereIn("id", $favoriteServers);
        }])
            ->get();

        foreach ($games as $key => $game){
            if($game->servers->isEmpty()){
                unset($games[$key]);
            }
        }

        return view('account.favorites', compact("games"));
    }

    public function deleteServer($id): RedirectResponse
    {
        $server = Server::where("id", $id)->first();

        if($server->owner_id == Auth::id()){
            $server->delete();
        }

        return \redirect()->back();
    }

    /**
     *
     * AJAX: filters loading by game title
     *
     * @return JsonResponse
     */
    public function loadFilters(): JsonResponse
    {
        if(!\request("game_title"))
            return response()->json(["status" => false, "error" => "game_title empty"]);

        $filters = Filter::with(["game"])->whereHas("game", function($query){ $query->where("title", \request("game_title")); })->get();

        if($filters){
            return response()->json(["status" => true, "filters" => $filters]);
        }
        else{
            return response()->json(["status" => false, "error" => "filter in game ". \request("game_title") . " not found"]);
        }
    }

    /**
     *
     * AJAX: callback checking status
     *
     * @return JsonResponse
     */
    public function getResponseStatus(): JsonResponse
    {
        if(!\request("callback")){
            return response()->json(["status" => false, "error" => "Пустое значение callback'a"]);
        }

        if(!\request("callback") || !is_string(\request("callback")) || ! preg_match('/^http(s)?:\/\/[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(\/.*)?$/i', \request("callback"))){
            return response()->json(["status" => true, "message" => "Неверная ссылка. Серверу не удалось выполнить запрос."]);
        }

        $url = \request("callback");

        $client = new Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);

        try {
            $response = $client->post($url, [
                'json' => [
                    'nickname' => "testNickname",
                    'hash' => "testHash",
                    'time' => time()
                ]
            ]);

            if($response->getStatusCode() == 0){
                $httpcode = 404;
            }
            else{
                $httpcode = $response->getStatusCode();
            }
        }
        catch (ConnectException|GuzzleException $exception) {
            return response()->json(["status" => true, "message" => "Страница не найдена. Код статуса: 404"]);
        }

        return response()->json(["status" => true, "message" => "Запрос выполнен. Код статуса: {$httpcode}"]);
    }
}
