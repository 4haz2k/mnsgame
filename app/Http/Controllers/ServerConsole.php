<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerConnectionRequest;
use App\Http\Requests\ServerConsoleRequest;
use App\Http\Services\ServerConsole\ServerRcon;
use App\Http\Services\Utilities\SecurityService;
use App\Models\Server;
use App\Models\ServerRconHistory;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ServerConsole extends Controller
{
    public function __construct() {
        $this->middleware('serverConsole');
    }

    /**
     * @param ServerConnectionRequest $request
     * @return RedirectResponse
     */
    public function FirstTimeServerConnect(ServerConnectionRequest $request): RedirectResponse
    {
        $server = Server::where("owner_id", Auth::id())->where("id", $request->server_id)->first();

        if($server->is_launcher)
            $address = $request->address;
        else
            $address = $request->address ?? explode(":", $server->server_data)[0];

        $serverConnection = new ServerRcon(
            $address,
            (int)$request->rcon_port,
            $request->rcon_password
        );


        if($serverConnection->isConnected()) {
            $connectedTime = Carbon::now("Europe/Moscow");

            \App\Models\ServerRcon::create([
                "server_id" => $server->id,
                "address" => $address,
                "rcon_port" => (int)$request->rcon_port,
                "rcon_password" => SecurityService::cryptData($request->rcon_password, $request->user_key),
                "is_connected" => true,
                "activated_time" => $connectedTime->addMinutes(30)->toDateTimeString()
            ]);

            ServerRconHistory::create([
                "server_id" => $server->id,
                "log" => "MNS Game подключился к серверу {$address}:{$request->rcon_port}",
                "deleted" => false
            ]);

            Cookie::queue('user_key', $request->user_key, 1800);

            return back()->with([
                "isConnected" => true,
                "timeLeft" => $connectedTime->addMinutes(30)->unix() - Carbon::now("Europe/Moscow")->unix()
            ]);
        } else {
            return back()->with([
                "isConnected" => false,
                "connectionError" => "<b>Адрес подключения:</b> {$address}:{$request->rcon_port}",
                "reason" => $serverConnection->getResponse()
            ]);
        }
    }

    public function connectToServer(ServerConsoleRequest $request): RedirectResponse
    {
        $server = Server::with("serverRcon")->where("id", $request->server_id)->where("owner_id", Auth::id())->firstOrFail();

        if(!SecurityService::decryptData($server->serverRcon->rcon_password, $request->user_key)) {
            return back()->with([
                "isConnected" => false,
                "reason" => "Неверный секретный ключ."
            ]);
        }

        $serverRconModel = $server->serverRcon;

        $serverConnection = new ServerRcon(
            $serverRconModel->address,
            $serverRconModel->rcon_port,
            SecurityService::decryptData($serverRconModel->rcon_password, $request->user_key)
        );

        if($serverConnection->isConnected()) {
            Cookie::queue('user_key', $request->user_key, 1800);

            ServerRconHistory::create([
                "server_id" => $server->id,
                "log" => "MNS Game подключился к серверу {$serverRconModel->address}:{$serverRconModel->rcon_port}",
                "deleted" => false
            ]);

            $serverRconModel->is_connected = true;
            $serverRconModel->activated_time = Carbon::now("Europe/Moscow")->addMinutes(30)->toDateTimeString();
            $serverRconModel->save();

            return back()->with([
                "isConnected" => true,
                "timeLeft" => Carbon::parse($serverRconModel->activated_time, "Europe/Moscow")->unix() - Carbon::now("Europe/Moscow")->unix()
            ]);
        } else {
            return back()->with([
                "isConnected" => false,
                "connectionError" => "<b>Адрес подключения:</b> {$serverRconModel->address}:{$serverRconModel->rcon_port}",
                "reason" => $serverConnection->getResponse()
            ]);
        }
    }

    /**
     *
     * AJAX: отправка команды на сервер
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function sendCommand(Request $request): JsonResponse
    {
        $server = Server::with("serverRcon")->where("id", $request->server_id)->where("owner_id", Auth::id())->firstOrFail();

        ServerRconHistory::create([
            "server_id" => $server->id,
            "log" => $request->command,
            "by_user" => true,
            "deleted" => false
        ]);

        $serverRconModel = $server->serverRcon;

        $serverConnection = new ServerRcon(
            $serverRconModel->address,
            $serverRconModel->rcon_port,
            SecurityService::decryptData($serverRconModel->rcon_password, Cookie::get("user_key"))
        );

        if($serverConnection->isConnected()) {
            $response = $serverConnection->sendCommand($request->command);

            ServerRconHistory::create([
                "server_id" => $server->id,
                "log" => $response,
                "deleted" => false
            ]);

            if($response) {
                return response()->json([
                    "message" => $response,
                    "time" => Carbon::now("Europe/Moscow")->format("d.m.Y H:i:s")
                ]);
            } else {
                return response()->json([
                    "message" => "Не удалось отправить команду.",
                    "time" => Carbon::now("Europe/Moscow")->format("d.m.Y H:i:s")
                ]);
            }

        } else {
            return response()->json([
                "message" => "Не удалось подключиться к серверу.",
                "time" => Carbon::now("Europe/Moscow")->format("d.m.Y H:i:s")
            ]);
        }
    }

    public function deleteConnection(Request $request): JsonResponse
    {
        $server = Server::with("serverRcon")->where("id", $request->server_id)->where("owner_id", Auth::id())->firstOrFail();

        $server->serverRcon->delete();

        ServerRconHistory::where("server_id", $server->id)->update(["deleted" => true]);

        return response()->json([
            "is_deleted" => true
        ]);
    }
}
