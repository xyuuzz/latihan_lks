<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\Admin;

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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get("landing-page", "HomeController@landingPage");

Route::middleware(["auth", Admin::class])->group(function() {
    Route::resource("blog", "BlogController")
        ->scoped(["blog" => "slug"]);
    Route::get("search", "BlogController@search");
});
