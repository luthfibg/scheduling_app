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
    Route::get('home', 'create')->name('tasks.add');
    Route::get('home', 'show')->name('tasks.current');
    Route::post('home', 'store')->name('tasks.save');
    Route::get('home/{task}', 'edit')->name('tasks.edit');
    Route::put('home/{task}', 'update')->name('tasks.update');
    Route::delete('home/{task}', 'destroy')->name('tasks.delete');
});
