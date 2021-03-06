<?php

namespace App\Http\Controllers;

use App\Products;
use App\ProductTypes;
use Illuminate\Http\Request;

class ProductTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // //方法一 去抓到type id(已知對應關聯)
        // $products = Products::where('product_type_id',$product_type_id)->get();

        // //方法二 先找出type再去做關聯 find($product_type_id)->這個是Model裡面function的products;
        // $products = ProductTypes::find($product_type_id)->products;

        // //方法三 with 有relations可抓到父子層的東西
        // // $product_type =ProductTypes::where('id',$product_type_id)->with('products')->get();

        // $product_type =ProductTypes::where('id',$product_type_id)->with('products')->get();

        // return view('Front/product',compact($product_type));
        $product_types = ProductTypes::all();

        return view('admin/product_types/index',compact('product_types'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/product_types/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProductTypes::create($request->all());

        return redirect('/admin/product_types');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $product_type =ProductTypes::find($id);

        return view('admin.product_types.edit',compact('product_type'));
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
        $product_type = ProductTypes::find($id);
        $product_type->update($request->all());
        return redirect('/admin/product_types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductTypes::destroy($id);

        return redirect('/admin/product_types');
    }
}
