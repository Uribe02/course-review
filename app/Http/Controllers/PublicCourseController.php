<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class PublicCourseController extends Controller
{
    // Método para el listado de cursos (home)
    public function index()
    {
        $courses = Course::latest()->paginate(10);
        
        return view('home', ['courses' => $courses]);
    }

    // Método para el detalle del curso (usa Eager Loading)
    public function show(Course $course)
    {
        $course->load('reviews.user'); 
        
        return view('courses.show', ['course' => $course]);
    }
}