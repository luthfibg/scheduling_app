<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\HomeController;

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

Route::get('home', [HomeController::class, 'index'])->name('home');

Route::controller(TaskController::class)->group(function() {
    Route::get('home', 'create')->name('tasks.add');
    Route::get('home', 'show')->name('tasks.current');
    Route::post('home/save', 'store')->name('tasks.save');
    Route::get('home/edit/{task}', 'edit')->name('tasks.edit');
    Route::put('home/update/{task}', 'update')->name('tasks.update');
    Route::delete('home/delete/{task}', 'destroy')->name('tasks.delete');
});
