<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        return view('Front/index');
    }

    public function news(){
        return view('Front/news');
    }

    public function news_info(){
        return view('Front/news_info');
    }

    public function contact_us(){
        return view('Front/contact_us');
    }
}
