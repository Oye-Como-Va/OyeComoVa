<?php

use App\Http\Controllers\TasksController;
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

//Aplicamos el middleware a todas las rutas porque no puede hacerse uso de la app sin registro:
Route::prefix('/home')->middleware('auth')->group(
    function () {
        Route::get('/', function () {
            return view('/main');
        });

        Route::prefix('/calendar')->group(
            function () {
                Route::get('/', [TasksController::class, 'show_tasks'])->name('calendar');
                Route::post('/create', [TasksController::class, 'create_task'])->name('task.create');
            }
        );



        Route::get('/register', function () {
            return view('register');
        })->name('registro');
    }

);

Route::get('/workingArea', [TasksController::class, 'show_tasks'])->name('workingArea');
