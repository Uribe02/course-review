<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Support\Str; 
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Módulo 2: Muestra el listado de cursos para la administración (dashboard/courses).
     */
    public function index()
    {
        // Obtiene los cursos más recientes y los pagina (10 por página)
        $courses = Course::latest()->paginate(10);
        
        // Carga la vista de administración
        return view('courses.index', compact('courses'));
    }

    /**
     * Muestra el formulario para crear un nuevo curso.
     */
    public function create()
    {
        // Retorna la vista Blade donde está el formulario de creación
        return view('courses.create');
    }

    /**
     * Valida los datos y guarda el nuevo curso.
     * Utiliza StoreCourseRequest para la validación (Buena Práctica).
     */
    public function store(StoreCourseRequest $request) 
    {
        $validated = $request->validated();
        
        // Genera el slug a partir del título validado
        $validated['slug'] = Str::slug($validated['title']);

        Course::create($validated);

        // Redirige al dashboard de cursos con mensaje de éxito
        return redirect()->route('courses.index')->with('success', 'Curso creado exitosamente.');
    }

    // El método show se omite aquí, ya que la ruta pública lo manejará.

    /**
     * Muestra el formulario de edición.
     * @param \App\Models\Course $course (Route Model Binding)
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Valida y actualiza el curso.
     * Utiliza UpdateCourseRequest para la validación.
     * @param \App\Models\Course $course (Route Model Binding)
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $validated = $request->validated();
        
        // Genera el slug actualizado
        $validated['slug'] = Str::slug($validated['title']);

        $course->update($validated);

        return redirect()->route('courses.index')->with('success', 'Curso actualizado exitosamente.');
    }

    /**
     * Elimina el curso.
     * @param \App\Models\Course $course (Route Model Binding)
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Curso eliminado.');
    }
}