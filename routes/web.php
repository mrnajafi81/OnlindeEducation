<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\TeachersController;
use App\Http\Controllers\admin\CoursesController;
use App\Http\Controllers\admin\LessonsController;
use App\Http\Controllers\admin\QuestionsController;

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

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::resource('teachers', TeachersController::class)->except('show');
    Route::resource('courses', CoursesController::class);

    Route::controller(LessonsController::class)->name('lessons.')->group(function () {
        // this rote that need to know course id
        Route::prefix('courses/{course}/lessons')->group(function (){
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
        });
        // this rote that no need to know course id
        Route::prefix('courses/lessons')->group(function (){
            Route::post('/','store')->name('store');
            Route::get('/{lesson}/edit','edit')->name('edit');
            Route::put('/{lesson}','update')->name('update');
            Route::delete('/{lesson}/destroy','destroy')->name('destroy');
        });
    });

    Route::controller(QuestionsController::class)->name('questions.')->group(function () {
        // this rote that need to know lesson id
        Route::prefix('lessons/{lesson}/questions')->group(function (){
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
        });
        // this rote that no need to know lesson id
        Route::prefix('lessons/questions')->group(function (){
            Route::post('/','store')->name('store');
            Route::get('/{question}/edit','edit')->name('edit');
            Route::put('/{question}','update')->name('update');
            Route::delete('/{question}/destroy','destroy')->name('destroy');
        });
    });
});
