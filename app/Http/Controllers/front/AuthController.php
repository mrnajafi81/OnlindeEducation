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
use Illuminate\Validation\Rules\Password;

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

    public function logout()
    {
        Auth::logout();
        return redirect(route('front.index'));
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

        //تنظیم یک سشن برای اینکه در صفحه وریفای شماره بفهمیم برای ثبت نام است یا بازیابی رمز عبور
        session()->put('authType', 'register');

        if ($sendResutl) {
            //verify code sent
            //سشن یکبار مصرف verify-send برای این ارسال می شود که اگر صفحه رفرش شد تایمر رفرش نشود
            return redirect(route('auth.verify-number-form'))->with('verify-send', true);
        } else {
            //verify code not be sent
            return back()->withErrors("مشکلی رخ داده است. لطفا بعدا دوباره امتحان کنید.");
        }

    }

    public function forgetPasswordForm()
    {
        return view('front.auth.forget_password');
    }

    public function forgetPassword(Request $request)
    {
        //validation request
        $request->validate([
            'number' => ['required', 'numeric', 'digits:11'],
        ]);

        //find user with entered number
        $user = User::where('number', $request->number)->first();
        if (!$user)
            return back()->withErrors('کاربری با شماره وارد شده یافت نشد.');

        //send verify code
        $sendResutl = $this->generateAndSendVerifyCode($request->number);

        //تنظیم یک سشن برای اینکه در صفحه وریفای شماره بفهمیم برای ثبت نام است یا بازیابی رمز عبور
        session()->put('authType', 'forgetPassword');

        // store user number in session for verifyNumberForm
        session()->put('user', ['number' => $user->number]);

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
        $verify = session()->pull('verify');
        if (!$verify)
            return redirect(route('auth.index'));

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

        //گرفتن اطلاعات سشن authAction برای فهمیدن اینکه باید ثبت نام انجام شود یا بازیابی رمز عبور
        $authType = session()->get('authType');
        if (!$authType || !(in_array($authType, ['register', 'forgetPassword'])))
            return redirect(route('auth.index'));

        if ($authType == 'register')
            return $this->doRegister();

        if ($authType == 'forgetPassword') {
            session()->put('verifyNumberTime', Carbon::now()->timestamp);
            return redirect(route('auth.change-password-form'));
        }


    }

    public function doRegister()
    {
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

    public function changePasswordForm()
    {
        //چک کردن اینکه کاربر حتما شماره خود را وریفای کرده باشد
        $verifyNumberTime = session()->get('verifyNumberTime');
        $now = Carbon::now()->timestamp;
        if (!$verifyNumberTime || ($now - $verifyNumberTime > (5 * 60)))
            return redirect(route('auth.forget-password-form'))->withErrors('لطفا اول شماره تلفن همراه خود را اعتبار سنجی کنید.');

        return view('front.auth.change_password');
    }

    public function changePassword(Request $request)
    {
        //validation request
        $request->validate([
            'password' => ['required', 'min:8', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        //get user number from session
        $number = session()->pull('user')['number'];
        if (!$number)
            return redirect(route('auth.forget-password-form'))->withErrors('لطفا اول شماره تلفن همراه خود را اعتبار سنجی کنید.');

        // get user from database
        $user = User::where('number', $number)->first();
        if (!$user)
            abort(404);


        //changer user password
        $user->password = Hash::make($request->password);
        $user->save();

        //حذف سشن وریفای تلفن
        session()->forget('verifyNumberTime');

        //سشن لاگین برای این است که در صفحه auth تب مربوط به لاگین فعال شود
        return redirect(route('auth.index'))->with(['login' => true, 'success' => 'پسورد شما با موفقیت تغییر کرد']);
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
