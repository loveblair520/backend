<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTypes extends Model
{
    protected $fillable = [
        'type_name','sort'
    ];
}
