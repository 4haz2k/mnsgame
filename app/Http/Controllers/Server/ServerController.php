<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\ServerData;
use App\Http\Requests\StoreServer;
use App\Http\Services\ImageService;
use App\Models\Filter;
use App\Models\FilterOfServer;
use App\Models\Game;
use App\Models\Server;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ServerController extends Controller
{
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
        $games = \App\Models\Game::all();
        return view("account.addserver", compact("games"));
    }

    /**
     * @param StoreServer $request
     * @return RedirectResponse
     */
    public function createServer(StoreServer $request): RedirectResponse
    {
        $game_id = Game::where("title", \request("game_title"))->first()->id;
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
        $server->description = \request("server_description");
        $server->is_launcher = $is_launcher != null;
        $server->server_data = $server_data;
        $server->banner_img = $image->handleUploadedImage($request);
        $server->callback = \request("server_callback");
        $server->site = \request("server_site");
        $server->vk = \request("server_vk");
        $server->discord = \request("server_discord");
        $server->game_id = $game_id;
        $server->owner_id = Auth::id();
        $server->save();

        if(\request("filters_input") != null){
            $filters_id = Filter::whereIn("filter", json_decode(\request("filters_input")))->get()->pluck("id");

            $filters_of_server_array = [];

            foreach ($filters_id as $filter_id) {
                array_push($filters_of_server_array, [
                    "filter_id" => $filter_id,
                    "server_id" => $server->id,
                ]);
            }

            FilterOfServer::insert($filters_of_server_array);
        }

        return Redirect::back()->with("Status", true);
    }

    public function editServer(Request $request){
        $server = Server::where("id", $request->id)->where("owner_id", Auth::id())->firstOrFail();
        return view('account.editserver', compact("server"));
    }

    /**
     *
     * Сохранение сервера
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function saveServer(Request $request): RedirectResponse
    {
        $server = Server::where("id", $request->id)->where("owner_id", Auth::id())->firstOrFail();

        $request_data = $request->all();
        $request_data["game_id"] = DB::table('games')->where("title", "=", $request_data["game"])->value("id");
        $request_data = array_merge($request_data, ['owner_id' => Auth::id()]);
        unset($request_data["game"]);

        $rules = Server::rules();

        $server_data_check = DB::table('servers')->where("owner_id", "=", Auth::id())->where("server_data", "=",  $request->server_data)->value("id");

        if($server_data_check == $server->id){
            unset($rules["server_data"]);
            $validator = Validator::make($request_data, $rules);
        }
        else{
            $validator = Validator::make($request_data, $rules);
        }

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else{
            $server->title = $request_data["title"];
            $server->description = $request_data["description"];
            $server->server_data = $request_data["server_data"];
            $server->game_id = $request_data["game_id"];
            $server->save();
            return Redirect::back()->with("Status", true);
        }
    }

    public function myServers(){
        $games = Game::with(["servers" => function ($query){
            $query->selectRaw("*, (select count(*) from `server_rates` where `servers`.`id` = `server_rates`.`server_id`) * ".ServerData::coefficient." + IFNULL((select rating from `server_ratings` where `servers`.`id` = `server_ratings`.`server_id`), 0) as `rating`");
        }])
            ->whereHas("servers", function ($q){
                $q->where("owner_id", Auth::id());
            })
            ->get();

        return view('account.myservers', compact("games"));
    }

    public function getServerPage($id){
        $server = Server::where("id", $id)->with(["game", "filters"])
            ->selectRaw("`servers`.*,(select count(*) from `server_rates` where `servers`.`id` = `server_rates`.`server_id`) * ".ServerData::coefficient." + IFNULL((select rating from `server_ratings` where `servers`.`id` = `server_ratings`.`server_id`), 0) as `rating`")
            ->firstOrFail();

        return view("server", compact("server"));
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
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
        curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT,10);
        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if($httpcode === 0){
            $httpcode = 404;
        }

        return response()->json(["status" => true, "message" => "Запрос выполнен. Код статуса: {$httpcode}"]);
    }
}
