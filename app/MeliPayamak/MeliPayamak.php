<?php

namespace App\MeliPayamak;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MeliPayamak
{
    public static function sendVerifyCode(string $number, string $code)
    {
        $result = Http::post('https://console.melipayamak.com/api/send/shared/dd75187b886d4c4a98731fc639b28965', [
            'bodyId' => 148938,
            'to' => $number,
            'args' => [$code]
        ])->json();

        if(array_key_exists('recId',$result) && $result['recId']){
            return true;
        }else{
            Log::error($result);
            return false;
        }
    }
}
