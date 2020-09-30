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
        return view('Front/news',compact('news_list'));
    }

    public function news_info($news_id)
    {    $news = DB::table('news')->where('id','=',$news_id)->first();
        return view('Front/news_info',compact('news'));
    }

    public function contact_us()
    {
        return view('Front/contact_us');
    }

    public function store_contact(Request $request)
    {
        // dd($request->email);
        DB::table('places')->insert(

            ['email' => $request->email,
            'location' => $request->location,
            'upload_img' => '',
            'attraction_name' => $request->attraction_name,
            'description' => $request->description,

            ]

        );
        // return 'success';
    }

}
