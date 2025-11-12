<?php
$pdo = new PDO('mysql:host=localhost;dbname=swabina01', 'root', '');

echo "=== REMOVING MIGRATIONS TABLE ===\n\n";

try {
    // Drop migrations table
    $pdo->exec("DROP TABLE IF EXISTS migrations");
    echo "✓ Migrations table dropped\n\n";
    
    // Verify current tables
    echo "=== REMAINING DATABASE TABLES ===\n\n";
    $tables = $pdo->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'swabina01' ORDER BY TABLE_NAME")->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($tables as $i => $t) {
        echo ($i+1) . ". " . $t['TABLE_NAME'] . "\n";
    }
    echo "\nTotal tables: " . count($tables) . "\n";
    echo "\n✓ Database cleaned! Migrations table removed.\n";
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
