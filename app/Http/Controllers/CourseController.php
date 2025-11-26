<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Support\Str; // <-- Aseguramos la importación
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // ... (Métodos index, create) ...

    public function store(StoreCourseRequest $request) 
    {
        $validated = $request->validated();
        
        // El uso de 'Str::slug' está ahora garantizado por el 'use'
        $validated['slug'] = Str::slug($validated['title']); 

        Course::create($validated);

        return redirect()->route('courses.index')->with('success', 'Curso creado exitosamente.');
    }

    // ... (Métodos edit, update, destroy) ...
}