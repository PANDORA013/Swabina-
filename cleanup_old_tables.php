<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

// Disable foreign key checks
DB::statement('SET FOREIGN_KEY_CHECKS=0');

$tables = ['permissions', 'admin_roles', 'role_permission', 'model_has_roles', 'model_has_permissions', 'role_has_permissions'];

foreach ($tables as $table) {
    if (DB::getSchemaBuilder()->hasTable($table)) {
        DB::statement("DROP TABLE IF EXISTS `$table`");
        echo "✅ Dropped table: $table\n";
    }
}

// Re-enable foreign key checks
DB::statement('SET FOREIGN_KEY_CHECKS=1');

echo "\n✅ Cleanup complete!\n";
