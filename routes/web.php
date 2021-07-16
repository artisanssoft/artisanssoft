<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\AffiliateController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/mytokens', [TokenController::class, 'index'])->name('token-page');
Route::get('/affiliates', [AffiliateController::class, 'index'])->name('affiliate-page');


