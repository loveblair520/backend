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

        // 第一種上傳方式file storage
        //檔案上傳並取得圖片名稱
        // $file_name = $request->file('image_url')->store('','public');

        // $requestData['image_url']= $file_name;

        // 第二種檔案上傳方式 move
        if($request->hasFile('image_url')){
            $file = $request->file('image_url');
            $path = $this->fileUpload($file,'news');
            $requestData['image_url'] = $path;
        }



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
        //取得特定一筆資料
        // $news = News::where('id','=',$id)->first();
        //用find只能找id
        $news = News::find($id);

        // dd($news);
        return view('admin.news.edit',compact('news'));

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
        //dd($request->all());
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

    private function fileUpload($file,$dir){
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if(! is_dir('uplaod/')){
            mkdir('upload/');
        }
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if(! is_dir('uplaod/'.$dir)){
            mkdir('upload/'.$dir);
        }


        //取得檔案的副檔名
        $extension = $file->getClientOriginalExtension();
        //檔案名稱會被重新命名
        $filename = strval(time().md5(rand(100,200))).'.'.$extension;
        //移動到指定路徑
        move_uploaded_file($file, public_path().'/upload/'.$dir.'/'.$filename);
        //回傳 資料庫儲存用的路徑格式
        return '/upload/'.$dir.'/'.$filename;
    }


}
