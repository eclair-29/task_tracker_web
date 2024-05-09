<?php

use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TasksController;
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
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::post('/backoffice/utilities/users', [BackOfficeController::class, 'addUser'])->name('backoffice.utilities.users.store');
    Route::get('/backoffice', [BackOfficeController::class, 'index'])->name('backoffice.index');
    Route::get('/backoffice/users', [BackOfficeController::class, 'users'])->name('backoffice.users');
    Route::get('/backoffice/utilities/users', [BackOfficeController::class, 'viewUsers'])->name('backoffice.utilities.users');
    Route::get('/backoffice/utilities/users/statuses', [BackOfficeController::class, 'getUserStatuses']);
});

Route::controller(TasksController::class)->group(function () {
    Route::post('/tasks', 'store')->name('tasks.store');
    Route::get('/tasks', 'all')->name('tasks.all');
    Route::get('/tasks/user', 'user')->name('tasks.user');
    Route::get('/tasks/create', 'create')->name('tasks.create');
    Route::get('/tasks/priorities', 'priorities')->name('tasks.priorities');
    Route::get('/tasks/statuses', 'statuses')->name('tasks.statuses');
    Route::get('/tasks/ticket', 'generateTicketId')->name('tasks.ticket');
    Route::put('/tasks/{id}', 'update')->name('tasks.update');
    Route::delete('/tasks/{id}', 'destroy')->name('tasks.destroy');
});
