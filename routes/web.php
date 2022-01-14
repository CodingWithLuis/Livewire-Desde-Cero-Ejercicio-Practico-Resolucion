<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/employees/index', \App\Http\Livewire\Employees\Index::class)->name('employees.index');
Route::get('/employees/create', \App\Http\Livewire\Employees\Create::class)->name('employees.create');
Route::get('/employees/{employee}/edit', \App\Http\Livewire\Employees\Edit::class)->name('employees.edit');
