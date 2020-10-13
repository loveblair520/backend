<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTypes extends Model
{
    protected $table = 'product_types' ;

    protected $fillable = [
        'type_name','sort'
    ];
}
