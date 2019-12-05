<?php

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

use \Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\App;
use \Illuminate\Support\Facades\Session;

Auth::routes();

Route::get('/{any}', function () {
    return view('home');
})->where('any', '.*');
