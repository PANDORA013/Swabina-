<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

use Illuminate\Support\Facades\Artisan;

echo "=== RUNNING DATABASE SEEDERS ===\n\n";

// Run all seeders
try {
    Artisan::call('db:seed', ['--force' => true]);
    echo Artisan::output();
    
    echo "\n=== SEEDING COMPLETED ===\n";
    
    // Verify data
    $pdo = new PDO('mysql:host=localhost;dbname=swabina01', 'root', '');
    $tables = $pdo->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'swabina01' ORDER BY TABLE_NAME")->fetchAll(PDO::FETCH_ASSOC);
    
    echo "\n=== DATA STATUS ===\n\n";
    foreach($tables as $table) {
        $tableName = $table['TABLE_NAME'];
        $rows = $pdo->query("SELECT COUNT(*) as count FROM $tableName")->fetch(PDO::FETCH_ASSOC)['count'];
        echo "$tableName: $rows rows\n";
    }
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
