<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }
    public function loginSubmit(Request $request){
        //validation form
        $request->validate(
            //regras
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:8|max:22'
            ],
            //erros
            [
                'text_username.required' => 'Necessário preencher o email',
                'text_username.email' => 'Precisa ser um email válido',
                'text_password.required' => 'Necessário preencher a senha',
                'text_password.min' => 'Minimo de :min caracteres',
                'text_password.max' => 'Maximo de :max caracteres'

            ]
        );

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        try {
            DB::connection()->getPdo();
            echo "Connection is ok!";
        } catch (PDOException $e) {
            echo "Failed connection: " . $e->getMessage();
        }
    }

    public function logout(){
        echo 'logout';
    }
}
