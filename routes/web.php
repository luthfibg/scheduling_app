<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(TaskController::class)->group(function() {
    Route::get('task', 'create')->name('tasks.add');
    Route::post('task', 'store')->name('tasks.save');
    Route::put('task', 'edit')->name('tasks.edit');
    Route::delete('task', 'destroy')->name('tasks.delete');
});
