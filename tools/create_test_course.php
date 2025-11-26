<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Course;

try {
    $data = [
        'title' => 'Curso de prueba',
        'slug' => 'curso-de-prueba-' . time(),
        'description' => 'Descripción de prueba',
        'instructor' => 'Instructor Test'
    ];

    $course = Course::create($data);
    echo "Created course id: {$course->id}\n";
    print_r($course->toArray());
} catch (Exception $e) {
    echo "Error creating course: " . $e->getMessage() . PHP_EOL;
}
