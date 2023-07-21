<?php

namespace App\MeliPayamak;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MeliPayamak
{
    public static function sendVerifyCode(string $number, string $code)
    {
        $result = Http::post('https://console.melipayamak.com/api/send/shared/2fdb64a3c3834900adef068d3b6ab80a', [
            'bodyId' => 151677,
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
