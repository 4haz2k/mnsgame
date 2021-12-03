<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Http\Request;
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
        $validator = Validator::make($request->all(), Server::rules());

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else{
            Server::create($request->all());
            return Redirect::back()->with("Status", true);
        }
    }
}
