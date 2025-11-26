<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PublicCourseController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================================
// 🚀 RUTAS PÚBLICAS (SSR) - MÓDULO 3
// ==========================================================
Route::get('/', [PublicCourseController::class, 'index'])->name('home');
Route::get('/curso/{course:slug}', [PublicCourseController::class, 'show'])->name('courses.show');


// ==========================================================
// 🔐 RUTAS PROTEGIDAS (AUTENTICACIÓN) - MÓDULO 2 & 4
// ==========================================================

// Dashboard base: mostrar listado de cursos de administración
Route::get('/dashboard', [CourseController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rutas de Perfil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas de Administración de Cursos (CRUD - Módulo 2)
    Route::resource('courses', CourseController::class)->except(['index', 'show']);
    
    // Ruta explícita para el dashboard de gestión de cursos
    Route::get('/dashboard/courses', [CourseController::class, 'index'])->name('courses.index');
    
    // Ruta para guardar una reseña (Módulo 4)
    Route::post('/curso/{course:slug}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

// Rutas de autenticación de Breeze
require __DIR__.'/auth.php';