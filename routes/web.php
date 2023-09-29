<?php

use App\Http\Controllers\UserControllerResourece;
use App\Http\Controllers\DisasterControllerResourece;
use App\Http\Controllers\PostControllerResourece;
use App\Http\Controllers\ReqControllerResourece;
use App\Http\Controllers\AidControllerResourece;
use App\Http\Controllers\CategoryControllerResourece;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('udin');
});

Route::resource('user', UserControllerResourece::class);
Route::resource('dev-disaster', DisasterControllerResourece::class);
Route::resource('dev-post', PostControllerResourece::class);
Route::resource('dev-req', ReqControllerResourece::class);
Route::resource('dev-aid', AidControllerResourece::class);
Route::resource('dev-category', CategoryControllerResourece::class);
