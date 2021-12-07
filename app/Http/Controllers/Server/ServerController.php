<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Filter;
use App\Models\Game;
use App\Models\Server;
use App\Models\User;
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
        return view("account.addserver");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createServer(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request_data = $request->all();
        $request_data["game_id"] = DB::table('games')->where("title", "=", $request_data["game"])->value("id");
        $request_data = array_merge($request_data, ['owner_id' => Auth::id()]);
        unset($request_data["game"]);
        $validator = Validator::make($request_data, Server::rules());

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else{
            Server::create(array_merge($request_data, ['owner_id' => Auth::id()]));
            return Redirect::back()->with("Status", true);
        }
    }

    public function editServer(Request $request){
        $server = Server::where("id", $request->id)->where("owner_id", Auth::id())->firstOrFail();
        return view('account.editserver', compact("server"));
    }

    public function saveServer(Request $request): \Illuminate\Http\RedirectResponse
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
        $servers = User::find(Auth::id())->server;
        return view('account.myservers', compact("servers"));
    }
}
