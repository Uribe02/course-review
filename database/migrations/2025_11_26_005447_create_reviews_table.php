<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // Relación con el usuario que hace la reseña
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Relación con el curso reseñado
            $table->foreignId('course_id')->constrained()->onDelete('cascade');

            // Calificación del 1 al 5
            $table->unsignedTinyInteger('rating');

            // Comentario del usuario
            $table->text('comment');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
