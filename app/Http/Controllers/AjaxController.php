<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function image_upload(Request $request)
    {
        $ajax_img = $request->img_file;
    }
}
