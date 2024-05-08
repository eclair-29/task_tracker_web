<?php

use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Controller::class, 'index']);

Auth::routes();

Route::group(['middleware' => ['role:user']], function () {
    Route::get('/user', [UserController::class, 'index']);
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/backoffice', [BackOfficeController::class, 'index']);
});
