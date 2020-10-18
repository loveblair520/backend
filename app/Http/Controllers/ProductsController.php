<?php

namespace App\Http\Controllers;

use App\ProductImg;
use App\Products;
use App\ProductTypes;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $news_list = Products::with('product_types')->find(1);
        // with(函式名字)抓取跟此筆資料有關係的其他資料表的資料
        //Ｑ：為什麼要做關聯？ Ａ：每次搜尋都需要進不斷進出資料庫收集資料，對伺服器的負擔較大，讀取時間也會更久

        // dd($news_list);
        $news_list = Products::all();
        return view('admin.products.index',compact('news_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_types = ProductTypes::all();
        return view('admin.products.create',compact('product_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $files = $request->file('multi_images');
        // dd($files);

        $requestData = $request->all();
        if($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $path = $this->fileUpload($file,'products');
            $requestData['product_image'] = $path;
        }


        $product = Products::create($requestData);
        //取得剛剛建立資料的id
        $product_id = $product->id;

        //多圖上傳
        if($request->hasFile('multi_images')){
            $files = $request->file('multi_images');
            foreach($files as $file){
                $path = $this->fileUpload($file,'products');
                ProductImg::create([
                    'img_url' => $path,
                    'product_id' => $product_id,
                ]);
            }
        }

        return redirect('/admin/products');

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
        $products = Products::find($id);

        // dd($products->productImgs);

        $product_types = ProductTypes::all();
        return view('admin.products.edit',compact('products','product_types'));
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
        $products = Products::find($id);
        $requestData = $request->all();


        //判斷是否有上傳圖片 若有
        if($request->hasFile('product_image')){
            //刪除舊有圖片
            $old_image =  $products->product_image;
            File::delete(public_path().$old_image);
            //上傳新的圖片
            $file =$request->file('product_image');
            $path =$this->fileUpload($file,'news');

            //將新圖片的路徑，放入$RequestData中
            $requestData['product_image'] = $path;

        }

        $products->update($requestData);

        return redirect('/admin/products');
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
        $products = Products::find($id);
        $old_image = $products->product_image;
        File::delete(public_path().$old_image);

        //刪除資料庫資料
        Products::destroy($id);

        return redirect('/admin/products');
    }

    private function fileUpload($file,$dir){
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if( ! is_dir('upload/')){
            mkdir('upload/');
        }
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if ( ! is_dir('upload/'.$dir)) {
            mkdir('upload/'.$dir);
        }

        //取得檔案的副檔名
        $extension = $file->getClientOriginalExtension();
        //檔案名稱會被重新命名
        $filename = strval(time().md5(rand(100, 200))).'.'.$extension;
        //移動到指定路徑
        move_uploaded_file($file, public_path().'/upload/'.$dir.'/'.$filename);
        //回傳 資料庫儲存用的路徑格式
        return '/upload/'.$dir.'/'.$filename;
    }

}
