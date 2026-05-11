<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function about(){
        return view('public.about');
    }

    public function help(){
        return view('public.help');
    }
}
