<?php

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



Route::get('/xenditGet', [App\Http\Controllers\Api\XenditController::class, 'getListVa']);
Route::post('/xenditGet/invoice', [App\Http\Controllers\Api\XenditController::class, 'createVa']);
Route::post('/xenditGet/callback', [App\Http\Controllers\Api\XenditController::class, 'callback']);
Route::get('/balance', [App\Http\Controllers\HomeController::class, 'balance']);
