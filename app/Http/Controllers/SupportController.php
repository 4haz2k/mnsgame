<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(){
        return view('supportPages.support');
    }

    public function faqPage(){
        return view('supportPages.faq');
    }
}
