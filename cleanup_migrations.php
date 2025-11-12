<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Get database connection
$db = DB::connection();

echo "=== CLEANING UP ORPHANED MIGRATION RECORDS ===\n\n";

// Migrations to clean up (tables that were dropped)
$orphaned_migrations = [
    '2024_09_19_064512_create_sekilas_perusahaans_table',
    '2024_09_19_073535_create_sertifikat_penghargaans_table',
    '2024_10_04_145915_create_m_k_s_table'
];

echo "Orphaned migrations to remove:\n";
foreach($orphaned_migrations as $mig) {
    echo "  - $mig\n";
}

echo "\nDeleting from migrations table...\n";

$deleted = DB::table('migrations')
    ->whereIn('migration', $orphaned_migrations)
    ->delete();

echo "Deleted: $deleted records\n\n";

echo "=== MIGRATION TABLE AFTER CLEANUP ===\n\n";

$migrations = DB::table('migrations')
    ->orderBy('batch')
    ->orderBy('migration')
    ->get();

foreach($migrations as $mig) {
    echo "[Batch " . $mig->batch . "] " . $mig->migration . "\n";
}

echo "\nTotal remaining: " . $migrations->count() . " migrations\n";
