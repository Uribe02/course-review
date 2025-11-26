<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Course;

class PublicViewTest extends TestCase
{
    use RefreshDatabase; // Necesario para limpiar la DB antes de la prueba

    /**
     * Prueba 1: Verifica que la página de inicio carga con éxito[cite: 162, 262].
     */
    public function test_home_page_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200); 
    }

    /**
     * Prueba 2: Verifica que la página de detalle del curso carga y muestra el título[cite: 164, 263].
     */
    public function test_course_detail_page_displays_course_title(): void
    {
        // Creamos un curso de prueba
        $course = Course::factory()->create([
            'title' => 'Curso de SSR en Acción',
            'slug' => 'ssr-en-accion',
            'instructor' => 'Dr. Code'
        ]);

        $response = $this->get(route('courses.show', $course->slug));

        // Verifica el código 200 y que el título del curso se ve (Prueba de SSR)
        $response->assertStatus(200);
        $response->assertSee('Curso de SSR en Acción');
    }
}