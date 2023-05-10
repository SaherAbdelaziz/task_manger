<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//
//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('tasks/create', 'App\Http\Controllers\TaskController@create')->name('tasks.create')->middleware('admin');;
    Route::post('tasks', 'App\Http\Controllers\TaskController@store')->name('tasks.store');
    Route::get('tasks/statistics', 'App\Http\Controllers\TaskController@statistics')->name('tasks.statistics');
    Route::get('tasks', 'App\Http\Controllers\TaskController@index')->name('tasks.index');
});






