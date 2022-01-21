<?php

use App\Http\Controllers\TelegramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

$telegramUri = "/" . env("TELEGRAM_TOKEN");
Route::any($telegramUri, [TelegramController::class, "index"])->name("webhook");
Route::any("get-updates", [TelegramController::class, "getUpdates"]);
Route::post("send-message", [TelegramController::class, "sendMessage"]);
