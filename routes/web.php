<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Route;

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

Route::get("/", [HomeController::class, "index"]);

Route::get("/redirects", [HomeController::class, "redirects"]);
Route::get("/users", [AdminController::class, "users"]);
Route::get("/deleteUser/{id}", [AdminController::class, "deleteUser"]);
Route::get("/foodMenu", [AdminController::class, "foodMenu"]);
Route::post("/upload", [AdminController::class, "upload"]);

Route::get("/webhook", [TelegramController::class, "webhook"]);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
