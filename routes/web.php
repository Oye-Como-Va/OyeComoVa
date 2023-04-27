<?php

use App\Http\Controllers\CoursesController;
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


Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/calendar', function () {
    return view('calendar');
});

Route::get('/workingArea', function () {
    return view('workingAreaActive');
})->name('workingArea');;

Route::get('/register', function () {
    return view('register');
})->name('registro');

Route::get('courses', [CoursesController::class, 'courses'])->name('courses');

Route::get('/home', function () {
    return view('/main');
})->middleware('auth');
