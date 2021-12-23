<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function postimg (){
        return view ('img');
    }
    
    public function saveimg (Request $request){
        $request->file('post_img')->store('public/post_img');
        return redirect ('/create3');
    }
}
