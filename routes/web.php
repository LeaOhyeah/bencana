<?php

use App\Http\Controllers\HomepageController;
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

// Route::get('/home', function () {
//     return view('homepage.home');
// })->name('home');

Route::get('/coba', function () {
    return view('layouts.main2');
});

// homepage
Route::get('/dashboard', [HomepageController::class, 'dashboard'])->name('dashboard');
Route::get('/home', [HomepageController::class, 'index'])->name('home');

// test leaflet
Route::get('/test', [HomepageController::class, 'test'])->name('test');
Route::get('/geojson', [HomepageController::class, 'geojson'])->name('geojson');
Route::get('/getdata', [HomepageController::class, 'getData'])->name('getdata');

// manager table users as developer
Route::resource('user', UserControllerResourece::class);
Route::get('user/other/trash', [UserControllerResourece::class, 'trash'])->name('user.trash');
Route::post('user/other/restore', [UserControllerResourece::class, 'restore'])->name('user.restore');
Route::get('user/del-id-card/{id}', [UserControllerResourece::class, 'destroyIdCard'])->name('user.del-id-card');
Route::get('user/del-pp/{id}', [UserControllerResourece::class, 'destroyPP'])->name('user.del-pp');

// manager table disaster as developer
Route::resource('disaster', DisasterControllerResourece::class);
Route::get('disaster/other/trash', [DisasterControllerResourece::class, 'trash'])->name('disaster.trash');
Route::post('disaster/other/restore', [DisasterControllerResourece::class, 'restore'])->name('disaster.restore');

// manager table posts as developer
Route::resource('post', PostControllerResourece::class);
Route::get('post/other/trash', [PostControllerResourece::class, 'trash'])->name('post.trash');
Route::post('post/other/restore', [PostControllerResourece::class, 'restore'])->name('post.restore');

// manager table reqs as developer
Route::resource('req', ReqControllerResourece::class);
Route::get('req/other/trash', [ReqControllerResourece::class, 'trash'])->name('req.trash');
Route::post('req/other/restore', [ReqControllerResourece::class, 'restore'])->name('req.restore');

// manager table aids as developer
Route::resource('aid', AidControllerResourece::class);
Route::get('aid/other/trash', [AidControllerResourece::class, 'trash'])->name('aid.trash');
Route::post('aid/other/restore', [AidControllerResourece::class, 'restore'])->name('aid.restore');

// manager table categories as developer
Route::resource('category', CategoryControllerResourece::class);
Route::get('category/other/trash', [CategoryControllerResourece::class, 'trash'])->name('category.trash');
Route::post('category/other/restore', [CategoryControllerResourece::class, 'restore'])->name('category.restore');