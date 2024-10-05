<?php

namespace App\Services;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


class Operations{

    //decyrpt
    public static function decryptId($value){

        // check if $value is decrypted
        try {
            $value = Crypt::decrypt($value);
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }
        return $value;
    }
}
