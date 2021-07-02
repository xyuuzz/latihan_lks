<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\{AuthController, MovieController, BranchController, HomeController, StudioController, ScheduleController};

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


// route default
Route::get("/", [UserController::class, "index"])->name("index");


Route::get("/home", fn() => redirect()->route("index"));

Route::get("login", [AuthController::class, "index"])->name("login");
Route::post("login", [AuthController::class, "login"])->name("login_u");

Route::middleware("auth")->group(function() {

    Route::delete("schedule/{schedule:slug}/{page}", [ScheduleController::class, "destroy"])->name("schedule.destroy");
    Route::patch("schedule/{schedule:slug}/{page}", [ScheduleController::class, "update"])->name("schedule.update");
    Route::patch("schedule/{schedule:slug}/{page}", [ScheduleController::class, "update"])->name("schedule.update");

    Route::resource('movie', MovieController::class)
            ->scoped(["movie" => "slug"]);
    Route::resource('schedule', ScheduleController::class)
            ->scoped(["schedule" => "slug"])
            ->except(["destroy", "update"]);
    Route::resource('branch', BranchController::class)
            ->scoped(["branch" => "slug"]);
    Route::resource('studio', StudioController::class)
            ->scoped(["studio" => "slug"]);

    Route::get("logout", [AuthController::class, "logout"])->name("logout");
});
