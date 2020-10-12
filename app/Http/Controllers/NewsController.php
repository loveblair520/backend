<?php

namespace App\Http\Controllers;

use App\News;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news_list = News::all();
        return view('admin.news.index',compact('news_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        //檔案上傳並取得圖片名稱
        $file_name = $request->file('image_url')->store('','public');

        $requestData['image_url']= $file_name;

        News::create($requestData);
        // dd($requestData);
        // $new_news = new News();

        // $new_news->title = $request->title;
        // $new_news->sub_title = $request->sub_title;
        // $new_news->content = $request->content;
        // $new_news->image_url = $file_name;

        // $new_news->save();

        return redirect('/admin/news');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.news.edit');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //刪除舊有的圖片
        $news = News::find($id);
        $old_image = $news->image_url;
        // File::delete(public_path().$old_image);
    }
}
