<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\db;

class FrontController extends Controller

{

    public function index()
    {   $news_list = DB::table('news')->orderBy('id','desc')->take(3)->get();
        // dd($news_list);
        return view('Front/index',compact('news_list'));
    }

    public function news()
    {    $news_list = DB::table('news')->orderBy('id','desc')->paginate(3);
        // dd($news_list);
        return view('Front/index',compact('news_list'));
    }

    public function news_info()
    {
        return view('Front/news_info');
    }

    public function contact_us()
    {
        return view('Front/contact_us');
    }
}
