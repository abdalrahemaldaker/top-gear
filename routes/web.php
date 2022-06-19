<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\admin\CarController;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\RegisteredUserController;
use App\Http\Controllers\auth\ForgotPasswordController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Http\Controllers\auth\EmailVerificationController;
//use App\Http\Controllers\auth\EmailVerificationController;
use App\Http\Controllers\Public\CarController as PublicCarController;
use App\Http\Controllers\Public\CategoryController as PublicCategoryController;
use App\Http\Controllers\public\LocalizationController;
use App\Models\Color;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix( '{locale?}')->middleware('lang')->group(function(){

    Route::get('/',[HomeController::class, 'welcome'])->name('home');
    Route::view('/about', 'pages.about');
    Route::view('/contact-us', 'pages.contact');

    Route::view('/admin/cars/test', 'admin.cars.test')->name('test');
    //auth Routes
    Route::get('login',[LoginController::class, 'show'])->name('login')->middleware('guest');;
    Route::post('login',[LoginController::class, 'authenticate'])->middleware('guest');;

    Route::get('register',[RegisteredUserController::class, 'create'])->name('register');
    //->middleware('auth');
    Route::post('register',[RegisteredUserController::class, 'store']);
    //->middleware('auth');

    Route::post('logout',[LoginController::class,'logout'])->name('logout')->middleware('auth');

    Route::get('/forgot-password',[ForgotPasswordController::class, 'show'])->name('forgot-password')->middleware('guest');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->middleware('guest');

    Route::get('/email/verify', [EmailVerificationController::class, 'send'])->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}',[EmailVerificationController::class, 'receive'])->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification',[EmailVerificationController::class, 'resend'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');



    Route::get('/reset-password/{token}',[ResetPasswordController::class, 'show'])->middleware('guest')->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->middleware('guest')->name('password.update');


    Route::post('/contact-us', [MessageController::class,'store'])->name('messages.store');
    Route::get('cars', [carController::class ,'index'] )->name('car.index');
    Route::Resource('cars',PublicCarController::class);
    Route::Resource('categories',PublicCategoryController::class);

    Route::group(['as' => 'admin.' , 'prefix' => 'admin' , 'middleware' => 'auth'] ,function(){
        Route::get('messages', [MessageController::class ,'index'] );
        Route::get('messages/{message}', [MessageController::class , 'show'])->name('message.show');
        /* Route::get('cars', [carController::class ,'index'] )->name('car.index');
        Route::get('cars/create', [CarController::class, 'Create'])->name('cars.create');
        Route::post('cars', [CarController::class,'store'])->name('Car.store');
        Route::get('cars/{car}', [carController::class ,'show'] )->name('cars.show');
        Route::get('cars/{car}/edit', [carController::class ,'edit'] )->name('cars.edit');
        Route::put('cars/{car}', [carController::class ,'update'] )->name('cars.update');
        Route::delete('cars/{car}', [carController::class ,'destroy'] )->name('cars.destroy');*/
            Route::resource('cars',CarController::class);
            Route::resource('categories',categoryController::class);
            Route::resource('colors',ColorController::class);
            Route::resource('users',UserController::class);
    });
});






// Localization:


Route::get('/language/{locale}',[LocalizationController::class, 'get'])->name('locale.change');






?>
