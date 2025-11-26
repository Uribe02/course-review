<?php

namespace App\Http\Controllers;

use App\Models\Course; 
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Guarda una nueva reseña para un curso.
     */
    public function store(StoreReviewRequest $request, Course $course) 
    {
        $validated = $request->validated();

        // Creamos la reseña asociada al curso y al usuario autenticado
        $course->reviews()->create([
            'user_id' => auth()->id(), 
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        // Redirigimos de vuelta a la página del curso con mensaje de éxito
        return back()->with('success', 'Reseña enviada exitosamente.');
    }
}