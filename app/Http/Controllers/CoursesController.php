<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class CoursesController extends Controller
{
    public function courses()
    {
        $user = User::findOrFail(Auth::id());
        $courses = $user->courses;
        return view('courses', @compact('courses'));
    }
    public function subjects($id)
    {
        $course = Course::findOrFail($id);
        $subjects = $course->subjects;

        return view('subjects', compact('course', 'subjects'));
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
    public function create_subject(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|min:3',
                'color' => 'required',
                'description' => 'required|string|min:3',
            ]);
            $newSubject = new Subject();
            $newSubject->name = $request->name;
            $newSubject->color = $request->color;
            $newSubject->description = $request->description;
            $newSubject->qualification = $request->qualification;
            $newSubject->course_id = $request->course_id;
            $newSubject->save();

            return back()->with('mensaje', 'Asignatura añadida con éxito');
        } catch (Exception $e) {
            return back()->with('mensaje', $e->getMessage());
        }
    }

    public function get_subjects($id)
    {
        $course = Course::findOrFail($id);
        $subjects = $course->subjects;

        return response()->json($subjects);
    }
}
