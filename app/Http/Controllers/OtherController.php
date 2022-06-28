<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\JsonResponse;

class OtherController extends Controller
{
    public function promotePage(){
        return view("other.promote");
    }

    public function getServerBySearch(): JsonResponse
    {
        $servers = Server::where("title", "like", "%".request("title")."%")->limit(10)->get();

        return response()->json($servers);
    }
}
