<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\admin\CarController;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Public\CarController as PublicCarController;
use App\Http\Controllers\Public\CategoryController as PublicCategoryController;

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

Route::get('/',[HomeController::class, 'welcome'])->name('home');
Route::view('/about', 'pages.about');
Route::view('/contact-us', 'pages.contact');

Route::view('/admin/cars/test', 'admin.cars.test')->name('test');


Route::post('/contact-us', [MessageController::class,'store'])->name('messages.store');
Route::get('cars', [carController::class ,'index'] )->name('car.index');
Route::Resource('cars',PublicCarController::class);
Route::Resource('categories',PublicCategoryController::class);

Route::group(['as' => 'admin.' , 'prefix' => 'admin'] ,function(){
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

});









?>
