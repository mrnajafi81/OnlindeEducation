<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifyNumberRequest;
use App\MeliPayamak\MeliPayamak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('front.auth.form');
    }

    public function login(LoginRequest $request)
    {
        //چک کردن کپچای وارد شده
        if (!$this->validationCaptcha($request)) {
            return back()->withErrors(['captcha' => 'متن کپچای وارد شده اشتباه است.']);
        }

        //select user with entered number
        $user = User::where('number', $request->number)->first();

        //user not found
        if (!$user) {
            return back()->withErrors('شماره تلفن یا پسورد وارد شده اشتباه است');
        }

        //user password incorrect
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors('شماره تلفن یا پسورد وارد شده اشتباه است');
        }

        //login user
        $rememberMe = $request->remember_me ? true : false;
        Auth::login($user, $rememberMe);

        //redirect user according to role
        if ($user->role == 'admin') {
            return redirect(route('admin.index'));
        } else {
            //TODO: redirect user to profile when login
            return redirect(route('front.index'));
        }

    }

    public function preRegister(RegisterRequest $request)
    {
        //store user info in session
        session()->put('user', [
            'fullname' => $request->fullname,
            'number' => $request->number,
            'password' => Hash::make($request->password),
        ]);

        //send verify code
        $sendResutl = $this->generateAndSendVerifyCode($request->number);

        if ($sendResutl) {
            //verify code sent
            //سشن یکبار مصرف verify-send برای این ارسال می شود که اگر صفحه رفرش شد تایمر رفرش نشود
            return redirect(route('auth.verify-number-form'))->with('verify-send', true);
        } else {
            //verify code not be sent
            return back()->withErrors("مشکلی رخ داده است. لطفا بعدا دوباره امتحان کنید.");
        }

    }

    public function verifyNumberForm()
    {
        $number = session()->get('user')['number'];
        return view('front.auth.verify_number', compact('number'));
    }

    public function verifyNumber(VerifyNumberRequest $request)
    {
        //چک کردن کپچای وارد شده
        if (!$this->validationCaptcha($request)) {
            return back()->withErrors(['captcha' => 'متن کپچای وارد شده اشتباه است.']);
        }

        // get verify code info
        $verify = session()->get('verify');

        //چک کردن تاریخ انقضای وریفای کد
        $now = Carbon::now()->timestamp;
        $verifyCodeExpirationSecond = 120;
        if (($now - $verify['sendTime']) > $verifyCodeExpirationSecond) {
            return back()->withErrors('کد اعتبار سنجی منقضی شده است.');
        }

        //چک کردن صحت کد اعتبار سنجی
        if ($request->verify_code != $verify['code']) {
            return back()->withErrors('کد اعتبار سنجی وارد شده اشتباه است.');
        }

        //حذف سشن کد اعتبار سنجی
        session()->pull('verify');

        //گرفتن اطلاعات سشن کاربر که در pre-register ست شده بود.
        $userInfo = session()->pull('user');

        // store user to database
        $user = User::create($userInfo);

        //verify user number
        $user->number_verified_at = Carbon::now();
        $user->save();

        //login user
        Auth::login($user);

        //TODO: redirect user when registered
        return redirect(route('front.index'))->with('success', 'ثبت نام شما با موفقیت انجام شد.');
    }

    public function sendVerifyCodeAgain(Request $request)
    {
        $number = session()->get('user')['number'];

        //send verify code
        $sendResutl = $this->generateAndSendVerifyCode($number);

        if ($sendResutl) {
            //verify code sent
            //سشن یکبار مصرف verify-send برای این ارسال می شود که اگر صفحه رفرش شد تایمر رفرش نشود
            return redirect(route('auth.verify-number-form'))->with('verify-send', true);
        } else {
            //verify code not be sent
            return back()->withErrors(['sendVerifyCode' => "مشکلی رخ داده است. لطفا بعدا دوباره امتحان کنید."]);
        }

    }

    public function changeCaptcha()
    {
        return response()->json(['captcha' => captcha_src('flat')]);

    }

    private function generateAndSendVerifyCode(string $number)
    {
        //generate verify code
        $verifyCode = (string)random_int(10000, 99999);

        //store verify code info to session
        session()->put('verify', [
            'code' => $verifyCode,
            'sendTime' => Carbon::now()->timestamp,
        ]);

        try {
            return MeliPayamak::sendVerifyCode($number, $verifyCode);
        } catch (\Exception $e) {
            return false;
        }

    }

    private function validationCaptcha(Request $request)
    {
        $captcha_check = Validator::make($request->all(), [
            'captcha' => ['captcha'],
        ]);

        if ($captcha_check->fails()) {
            return false;
        }

        return true;
    }
}
