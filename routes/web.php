<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GlobalController;

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

Route::post('bot',[GlobalController::class, 'index'])->name('bot');
Route::get('test',[GlobalController::class, 'test'])->name('test');


// Route::resource('account',);