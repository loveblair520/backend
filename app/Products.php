<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'name', 'product_image', 'price','info','info_image','date','type_id'
    ];
}
