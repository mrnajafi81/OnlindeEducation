<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CoursesController;
use App\Http\Controllers\admin\GroupsController;
use App\Http\Controllers\admin\LessonsController;
use App\Http\Controllers\admin\QuestionsController;
use App\Http\Controllers\admin\TeachersController;
use App\Http\Controllers\front\AuthController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\front\IndexController;
use App\Http\Controllers\front\PayController;
use App\Http\Controllers\front\TestsController;
use App\Http\Controllers\admin\PaysController as AdminPaysController;
use App\Http\Controllers\admin\TestsController as AdminTestsController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\SlidersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//routes of admin section
Route::prefix('admin')->middleware(['auth', 'roleIs:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::resource('teachers', TeachersController::class)->except('show');

    Route::resource('courses', CoursesController::class)->except('show');

    //routes of lessons section
    Route::controller(LessonsController::class)->name('lessons.')->group(function () {

        // this rote that need to know course id
        Route::prefix('courses/{course}/lessons')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
        });

        // this rote that no need to know course id
        Route::prefix('courses/lessons')->group(function () {

            Route::post('/', 'store')->name('store');
            Route::get('/{lesson}/edit', 'edit')->name('edit');
            Route::put('/{lesson}', 'update')->name('update');
            Route::delete('/{lesson}/destroy', 'destroy')->name('destroy');

        });

    });

    //routes of questions section
    Route::controller(QuestionsController::class)->name('questions.')->group(function () {

        // this rote that need to know lesson id
        Route::prefix('lessons/{lesson}/questions')->group(function () {

            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');

        });

        // this rote that no need to know lesson id
        Route::prefix('lessons/questions')->group(function () {

            Route::post('/', 'store')->name('store');
            Route::get('/{question}/edit', 'edit')->name('edit');
            Route::put('/{question}', 'update')->name('update');
            Route::delete('/{question}/destroy', 'destroy')->name('destroy');

        });

    });

    Route::resource('groups', GroupsController::class)->except('show');

    Route::resource('pays', AdminPaysController::class)->only(['index', 'edit', 'update']);

    Route::name('admin')->resource('tests', AdminTestsController::class)->only(['index', 'destroy']);

    Route::resource('users', UsersController::class)->except(['show', 'delete']);

    Route::resource('sliders', SlidersController::class)->except(['show']);

});

//routes of auth section
Route::middleware('guest')->controller(AuthController::class)->name('auth.')->group(function () {

    //login and register form
    Route::get('auth', 'index')->name('index');

    //register
    Route::post('pre-register', 'preRegister')->name('pre-register');

    //login
    Route::post('login', 'login')->name('login');

    //forget password
    Route::get('forget-password', 'forgetPasswordForm')->name('forget-password-form');
    Route::post('forget-password', 'forgetPassword')->name('forget-password');
    Route::get('change-password', 'changePasswordForm')->name('change-password-form');
    Route::post('change-password', 'changePassword')->name('change-password');

    //verify number for register and forget password
    Route::get('verify-number', 'verifyNumberForm')->name('verify-number-form');
    Route::post('verify-number', 'verifyNumber')->name('verify-number');
    Route::post('send-verify-number-again', 'sendVerifyCodeAgain')->name('send-verify-code-again');

    //change captcha image
    Route::get('/change-captcha', 'changeCaptcha')->name('change_captcha');

});
Route::middleware('auth')->get('logout', [AuthController::class, 'logout'])->name('auth.logout');//logout TODO: change method to post

//routes of front section
Route::controller(IndexController::class)->name('front.')->group(function () {
    //home page
    Route::get('/', 'index')->name('index');

    Route::get('/all-courses', 'allCourses')->name('all-courses');

    //course page
    Route::get('courses/{course}', 'showCourse')->name('course');

    //lessons of course page
    Route::get('course/lessons/{lesson}', 'showCourseLessons')->name('lessons');
});

//route of checkout, payments, do tests section
Route::middleware(['auth', 'roleIs:admin,user'])->group(function () {

    //checkout page
    Route::get('checkout/{course}', [CheckoutController::class, 'index'])->name('checkout.index');

    //route of pay course section (redirect user to pay gateway and store course to user)
    Route::get('pay/request/{course}', [PayController::class, 'request'])->name('pay.request');
    Route::get('pay/verify', [PayController::class, 'verify'])->name('pay.verify');
    Route::get('pay/{pay}/successful', [PayController::class, 'successful'])->name('pay.successful');
    Route::get('pay/{pay}/unsuccessful', [PayController::class, 'unsuccessful'])->name('pay.unsuccessful');


    //routes of do test with user in front
    Route::controller(TestsController::class)->prefix('tests')->name('tests.')->group(function () {
        //show questions of lesson's test
        Route::get('/{lesson}', 'index')->name('index');
        //store user's test
        Route::post('/{lesson}', 'store')->name('store');
        //show result of test to user
        Route::get('/result/{test}', 'result')->name('result');
    });

});
