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

Auth::routes();

Route::group([
    'prefix' => '{locale?}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => \App\Http\Middleware\Localization::class], function () {

    Route::get('/', function () {
        return view('home');
    })->name('home');
});

Route::get('js/lang', function () {
    Artisan::call('cache:clear');
    $strings = Cache::rememberForever('lang.js', function () {
        $lang = App::getLocale();

        $files = glob(resource_path('lang/' . $lang . '/*.php'));
        $strings = [];

        foreach ($files as $file) {
            $name = basename($file, '.php');
            $strings[$name] = require $file;
        }

        return $strings;
    });

    header('Content-Type: text/javascript');
    echo('window.i18n = ' . json_encode($strings) . ';');
    exit();
})->name('assets.lang');
