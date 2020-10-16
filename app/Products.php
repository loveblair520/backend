<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products' ;

    protected $fillable = [
        'name', 'product_image', 'price','info','sort','date','product_type_id','info_image'
    ];

    public function product_types(){

        return $this->belongsTo('App\ProductTypes','type_id');
        //Laravel 在建立關係的時候，會以"資料表名稱＋_id的欄位內容（product_types_id）"作為搜尋條件

    }


}
