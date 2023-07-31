<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    //این تابع کمله storage/ را از استرینگ حذف می کند
    // این تابع برای حذف مدیا در کنترلر ها کاربرد دارد
    public function deleteStorageWordFromStr($str)
    {
        return str_replace('storage/', '', $str);
    }
}
