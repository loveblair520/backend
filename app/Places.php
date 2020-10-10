<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class places extends Model
{
    //

    protected $fillable = [
        'email', 'location', 'upload_img','attraction_name','description'
    ];
}
