<?php

namespace App\Services;


use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Operations
{
    public static function decryptId($value)
    {
        // checks if $value is encrypted
        try {
            $value = Crypt::decrypt($value);
        } catch (DecryptException $e) {
            return null;
        }
        return $value;
    }
}
