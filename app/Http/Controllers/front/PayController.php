<?php

namespace App\Http\Controllers\front;

use App\Gateway\Zarinpal;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Pay;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PayController extends Controller
{
    private $MerchantID = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";

    public function request(Course $course)
    {
        //کرفتن گروه آموزشی فعال این دوره که در حال حاضر ثبت نام برای آن انجام می شود.
        $enableGroupe = $course->groups()->where('ended_at', '>=', Carbon::now())->first();

        //چک کردن اینکه آیا ثبت نامی برای این دوره فعال هست
        if (!$enableGroupe) {
            return redirect(route('front.course', $course->id));
        }

        $user = auth()->user();

        //چک کرن اینکه از قبل کاربر این آموزش را نخریده باشد.
        $userHasThisCourse = $user->courses()->wherePivot('course_id', $course->id)->first() ? true : false;
        if ($userHasThisCourse)
            return redirect(route('front.course', $course->id));

        //اطلاعات موردنیاز برای ارسال به درگاه
        $MerchantID = $this->MerchantID;
        $Amount = $course->price;
        $Description = "ثبت نام دوره " . $course->title . " گروه آموزشی " . $enableGroupe->title;
        $Email = "";
        $Mobile = $user->number;
        $CallbackURL = route('pay.verify');
        $SandBox = true;
        $ZarinGate = false;

        //ارسال اطلاعات پرداخت برای زرین پال و دریافت نتیجه
        $zarinpal = new Zarinpal();
        $result = $zarinpal->request($MerchantID, $Amount, $Description, $Email, $Mobile, $CallbackURL, $SandBox, $ZarinGate);

        // بررسی نتیجه درخواست
        if (isset($result["Status"]) && $result["Status"] == 100) {

            //success, store pay info to database
            Pay::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'group_id' => $enableGroupe->id,
                'price' => $course->price,
                'authority' => $result['Authority'],
            ]);

            //redirect to gateway
            $zarinpal->redirect($result["StartPay"]);

        } else {
            // log errors
            Log::error($result);

            return back()->withErrors('خطایی رخ داده است لطفا بعدا دوباره تلاش کنید.');
        }

    }

    public function verify()
    {
        //دریافت آتورتی برگشتی از زرین پال
        if (isset($_GET['Authority']) && $_GET['Authority'] != "")
            $Authority = $_GET['Authority'];
        else
            abort(404);

        //دریافت اطلاعات پرداخت از دیتابیس به کمک آتوریتی یونیک برگشتی از زرین پال
        $pay = Pay::where('authority', $Authority)->first();
        if (!$pay)
            abort(404);

        //ارسال درخواست اعتبار سنجی (وریفای) پرداخت به زرین پال
        $MerchantID = $this->MerchantID;
        $Amount = $pay->price;
        $SandBox = true;
        $ZarinGate = false;

        $zarinpal = new zarinpal();
        $result = $zarinpal->verify($MerchantID, $Amount, $SandBox, $ZarinGate);

        // بررسی نتیجه برگشتی از زرین پال
        if (isset($result["Status"]) && $result["Status"] == 100) {
            // پرداخت موفق

            DB::beginTransaction();

            //update pay info
            $pay->update([
                'status' => true,
                'ref_id' => $result["RefID"],
            ]);

            //store course for user (register user for this course)
            auth()->user()->courses()->attach($pay->course_id, [
                'group_id' => $pay->group_id,
                'pay_id' => $pay->id,
            ]);

            DB::commit();

            return redirect(route('pay.successful', $pay->id));

        } else {
            // پرداخت ناموفق
            $result['comment'] = 'پرداخت ناموفق';
            Log::error($result);

            return redirect(route('pay.unsuccessful', $pay->id));
        }

    }

    public function unsuccessful(Pay $pay)
    {
        return view('front.unsuccessfulPay', compact('pay'));
    }

    public function successful(Pay $pay)
    {
        return view('front.successfulPay', compact('pay'));
    }

}
