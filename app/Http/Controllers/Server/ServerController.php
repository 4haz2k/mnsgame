<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function createServer(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), Server::rules());

        if ($validator->fails()) {
            return view()->json(['errors'=>$validator->errors()]);
        }
        else{
            Server::create($request->all());
            return response()->json(['Success' => true]);
        }
    }
}
