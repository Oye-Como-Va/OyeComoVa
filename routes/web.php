<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\WorkingAreaController;
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

Route::get('/register', function () {
    return view('register');
})->name('registro');

//Aplicamos el middleware a todas las rutas porque no puede hacerse uso de la app sin registro:
Route::prefix('/home')->middleware('auth')->group(
    function () {
        Route::get('/', function () {
            return view('/main');
        })->name('home');

        Route::prefix('/calendar')->group(
            function () {
                Route::get('/', [TasksController::class, 'show_tasks'])->name('calendar');
                Route::post('/create', [TasksController::class, 'create_task'])->name('task.create');
                Route::get('/edit/{id}', [TasksController::class, 'edit_task'])->name('task.edit');
                Route::delete('/delete/{id}', [TasksController::class, 'delete_task'])->name('task.delete');
                Route::put('/drag_drop/{id}', [TasksController::class, 'drag_drop_task'])->name('task.drag_drop');
                Route::put('/saveChanges/{id}', [TasksController::class, 'saveChanges'])->name('task.saveChanges');
            }
        );
        //Route::get('/workingArea', function () {
        //return view('workingAreaActive');
        // })->name('workingArea');

        Route::get('/workingArea', [WorkingAreaController::class, 'comprobar_task'])->name('workingArea');

        Route::get('/courses', [CoursesController::class, 'courses'])->name('courses');
        Route::post('/courses', [CoursesController::class, 'create_course'])->name('create_course');

        Route::post('/courses/create', [CoursesController::class, 'create_subject'])->name('create_subject');

        Route::get('/courses/{id}/subjects', [CoursesController::class, 'subjects'])->name('subjects');
    }
);
