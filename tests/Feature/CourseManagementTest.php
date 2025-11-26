<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Course;

class CourseManagementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba 3: Verifica que un invitado no puede acceder a la página de creación (Seguridad).
     */
    public function test_guest_cannot_access_create_course_page(): void
    {
        $response = $this->get(route('courses.create'));
        
        // Un invitado debe ser redirigido a la página de login
        $response->assertRedirect(route('login')); 
    }

    /**
     * Prueba 4: Verifica que un usuario autenticado puede crear un curso (Funcionalidad)[cite: 169, 265].
     */
    public function test_authenticated_user_can_create_a_course(): void
    {
        // Creamos y autenticamos un usuario
        $user = User::factory()->create();
        $this->actingAs($user); 

        $courseData = [
            'title' => 'Curso de Módulo 2',
            'description' => 'Descripción del CRUD.',
            'instructor' => 'Jane Doe',
            'slug' => 'curso-modulo-2'
        ];

        // Hacemos una solicitud POST para guardar el curso
        $response = $this->post(route('courses.store'), $courseData);
        
        // Esperamos una redirección con éxito
        $response->assertRedirect(route('courses.index')); 
        $response->assertSessionHas('success');

        // Verificamos que el curso existe en la base de datos
        $this->assertDatabaseHas('courses', [
            'title' => 'Curso de Módulo 2',
        ]);
    }
}