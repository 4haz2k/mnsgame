<?php

namespace App\Http\Controllers;

use Alexusmai\YandexMetrika\YandexMetrika;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPanel extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        $metrika = new YandexMetrika;
        $metrika->getTopPageViews()->adapt();
        $page_views = $metrika->adaptData;
        $metrika->getVisitsViewsUsers()->adapt();
        $name = Auth::user()->name. " " . Auth::user()->surname;
        return view('admin.home', compact("name", "page_views"));
    }
}
