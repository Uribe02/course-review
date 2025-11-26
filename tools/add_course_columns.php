<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

try {
    echo "Checking and adding missing columns on `courses`...\n";

    if (!Schema::hasTable('courses')) {
        echo "Table `courses` does not exist. Aborting.\n";
        exit(1);
    }

    Schema::table('courses', function (Blueprint $table) {
        if (!Schema::hasColumn('courses', 'title')) {
            $table->string('title')->after('id');
            echo "Will add: title\n";
        }
        if (!Schema::hasColumn('courses', 'slug')) {
            $table->string('slug')->unique()->after('title');
            echo "Will add: slug\n";
        }
        if (!Schema::hasColumn('courses', 'description')) {
            $table->text('description')->after('slug');
            echo "Will add: description\n";
        }
        if (!Schema::hasColumn('courses', 'instructor')) {
            $table->string('instructor', 100)->after('description');
            echo "Will add: instructor\n";
        }
    });

    echo "ALTER operations applied. Verifying:\n";
    $columns = DB::select('SHOW COLUMNS FROM courses');
    foreach ($columns as $c) {
        echo "- {$c->Field} ({$c->Type})" . PHP_EOL;
    }

    echo "Done.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
    exit(1);
}
