<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    echo "DB: " . DB::connection()->getDatabaseName() . PHP_EOL;
    $users = DB::table('users')->count();
    $courses = DB::table('courses')->count();
    $reviews = DB::table('reviews')->count();
    $migrations = DB::table('migrations')->count();
    echo "Counts:\n";
    echo "- users: {$users}\n";
    echo "- courses: {$courses}\n";
    echo "- reviews: {$reviews}\n";
    echo "- migrations: {$migrations}\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
