<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Solo usuarios autenticados pueden crear reseñas (Módulo 4)
        return auth()->check(); 
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Calificación (rating) debe ser requerida, numérica y entre 1 y 5
            'rating' => ['required', 'numeric', 'min:1', 'max:5'], 
            // El comentario es requerido
            'comment' => ['required', 'string', 'max:500'], 
        ];
    }
}