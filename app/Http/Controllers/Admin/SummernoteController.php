<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SummernoteController extends Controller
{
    public function upload(Request $request) {
        $img = $request->file('image');
        $filename = uniqid() . '.' . $img->getClientOriginalExtension();
        $img->move(public_path('assets/front/img/summernote/'), $filename);

        return url('/') . public_path("/assets/front/img/summernote/" . $filename);
    }
}
