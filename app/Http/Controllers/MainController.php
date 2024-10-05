<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        //load notes


        return view('home');
    }

    public function newNote(){
        echo 'criando uma nova nota';
    }
}
