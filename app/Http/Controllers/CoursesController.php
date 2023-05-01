<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class CoursesController extends Controller
{
    public function courses()
    {
        $courses = Course::all();
        return view('courses', @compact('courses'));
    }
    public function create_course(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|min:3',
                'description' => 'required|string|min:3',
            ]);
            $newCourse = new Course();
            $newCourse->name = $request->name;
            $newCourse->description = $request->description;
            $newCourse->save();

            $newCourse->users()->attach(Auth::id());

            return back()->with('mensaje', 'Curso añadido con éxito');
        } catch (Exception $e) {
            return back()->with('mensaje', $e->getMessage());
        }
    }
}
