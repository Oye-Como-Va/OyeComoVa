<?php

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

Route::get('/', function () {
    return view('landing');
});

Route::get('/main', function () {
    return view('main');
});

Route::get('/calendar', function () {
    return view('calendar');
});

Route::get('/workingArea', function () {
    return view('workingAreaActive');
})->name('workingArea');;

Route::get('/register', function () {
    return view('register');
});
