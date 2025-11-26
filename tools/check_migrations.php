<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    $rows = DB::table('migrations')->orderBy('id','desc')->limit(50)->get();
    echo "Migrations (last 50):\n";
    foreach ($rows as $r) {
        echo "- {$r->id} | {$r->migration} | {$r->batch}" . PHP_EOL;
    }
} catch (Exception $e) {
    echo "Error reading migrations table: " . $e->getMessage() . PHP_EOL;
}
