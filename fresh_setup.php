<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

echo "=== FRESH DATABASE SETUP ===\n\n";

$db_name = 'swabina01';
$host = 'localhost';
$user = 'root';
$pass = '';

try {
    // Connect to MySQL without database
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    
    echo "1. Dropping old database...\n";
    $pdo->exec("DROP DATABASE IF EXISTS `$db_name`");
    echo "   ✓ Database dropped\n\n";
    
    echo "2. Creating fresh database...\n";
    $pdo->exec("CREATE DATABASE `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "   ✓ Database created\n\n";
    
    // Now connect to the new database
    echo "3. Connecting to new database...\n";
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
    echo "   ✓ Connected\n\n";
    
    echo "4. Creating migrations table...\n";
    $pdo->exec("
        CREATE TABLE migrations (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255) NOT NULL,
            batch INT NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "   ✓ Migrations table created\n\n";
    
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    exit(1);
}

echo "=== DATABASE READY FOR MIGRATIONS ===\n";
echo "\nNow running: php artisan migrate\n\n";

// Run migrations
Artisan::call('migrate');
echo Artisan::output();

echo "\n=== VERIFICATION ===\n";
$tables = DB::select("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name'");
echo "Tables created: " . count($tables) . "\n\n";
foreach($tables as $table) {
    echo "  ✓ " . $table->TABLE_NAME . "\n";
}
