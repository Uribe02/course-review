<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "DB: " . DB::connection()->getDatabaseName() . PHP_EOL;
$has = Schema::hasColumn('courses','title') ? 'yes' : 'no';
echo "has_title: {$has}" . PHP_EOL;

try {
    $columns = DB::select('SHOW COLUMNS FROM courses');
    echo "Columns in `courses`:\n";
    foreach ($columns as $c) {
        echo "- {$c->Field} ({$c->Type})" . PHP_EOL;
    }
} catch (Exception $e) {
    echo "Error reading columns: " . $e->getMessage() . PHP_EOL;
}
