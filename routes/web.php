<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaunchPadController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\UserController;


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

// Route::middleware('checkLogin')->get('/', function () {
//     return view('index');
// });

// Route::post('/login',[UserController::class,'login'])->name('login-check');
// Route::post('/register',[UserController::class,'register'])->name('register.user');
// Route::get('/logout',[UserController::class,'logout'])->name('user.logout');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/', [LaunchPadController::class, 'index'])->name('launchpad')->middleware(['auth:sanctum', 'verified']);
Route::get('/mytokens', [TokenController::class, 'index'])->name('mytokens')->middleware(['auth:sanctum', 'verified']);
Route::get('/affiliates', [AffiliateController::class, 'index'])->name('affiliates')->middleware(['auth:sanctum', 'verified']);

// store referal id in cookies
Route::get('/referal', [UserController::class, 'referal']);


