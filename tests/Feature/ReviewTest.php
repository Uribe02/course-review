<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use App\Models\Review;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba 5: Verifica que un usuario autenticado puede enviar una reseña[cite: 171].
     */
    public function test_authenticated_user_can_submit_review(): void
    {
        // Crear y autenticar un usuario
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crear un curso
        $course = Course::factory()->create();

        $reviewData = [
            'rating' => 4,
            'comment' => 'Me gustó mucho.',
        ];

        // Enviar la reseña
        $response = $this->post(route('reviews.store', $course->slug), $reviewData);
        
        // Verificaciones
        $response->assertRedirect(); 
        $response->assertSessionHas('success');

        // Verificar que la reseña está en la DB
        $this->assertDatabaseHas('reviews', [
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);
    }

    /**
     * Prueba 6: Verifica que un invitado no puede enviar una reseña[cite: 173].
     */
    public function test_guest_cannot_submit_review(): void
    {
        // Crear un curso
        $course = Course::factory()->create();

        $reviewData = ['rating' => 1, 'comment' => 'Malo'];

        // Enviar la reseña como invitado
        $response = $this->post(route('reviews.store', $course->slug), $reviewData);
        
        // Debe ser redirigido a la página de login
        $response->assertRedirect(route('login')); 

        // Verificar que la reseña NO fue guardada
        $this->assertDatabaseMissing('reviews', ['course_id' => $course->id]);
    }
}