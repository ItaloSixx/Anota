<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index($value){
        return view('Main', ['value' => $value]);
    }

    public function page2($value){
        return view('Page3', ['value' => $value]);

    }

    public function page3($value){
        return view('Page3', ['value' => $value]);

    }
}
