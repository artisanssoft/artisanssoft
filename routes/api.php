<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\LoginRegisterController;
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

Route::post('api/register',[LoginRegisterController::class,'register'])->name('api.register')->middleware('api');
Route::post('api/login',[LoginRegisterController::class,'login'])->name('api.login')->middleware('api');
Route::get('api/login',[LoginRegisterController::class,'index'])->middleware('api');


// middleware('auth:sanctum')->post('api/register', function (Request $request) {
//     return $request->user();
// });
