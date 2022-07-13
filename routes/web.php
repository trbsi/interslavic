<?php

use App\Http\Controllers\TelegramController;
use App\Http\Controllers\TranslateController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::any('translate', [TranslateController::class, 'translate'])->name('translate');

Route::prefix('telegram')->group(function () {
    Route::get('set-webhook', [TelegramController::class, 'setWebHook'])->name('telegram.set-webhook');
    Route::get('webhook', [TelegramController::class, 'webhook'])->name('telegram.webhook');
});
