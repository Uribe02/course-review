<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Obtiene el ID del curso para ignorarlo en la validación de unicidad del slug
        $courseId = $this->route('course')->id; 

        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'instructor' => ['required', 'string', 'max:100'],
            'slug' => [
                'required',
                'string',
                'max:255',
                // Verifica que el slug sea único, ignorando el curso actual
                Rule::unique('courses')->ignore($courseId), 
            ],
        ];
    }
}