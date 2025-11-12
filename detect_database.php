<?php
$pdo = new PDO('mysql:host=localhost;dbname=swabina01', 'root', '');

echo "=== DETECTING ACTIVE DATABASE TABLES ===\n\n";

// Get all tables
$tables = $pdo->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'swabina01' ORDER BY TABLE_NAME")->fetchAll(PDO::FETCH_ASSOC);

echo "Active Tables Found: " . count($tables) . "\n\n";
foreach($tables as $i => $t) {
    echo ($i+1) . ". " . $t['TABLE_NAME'] . "\n";
}

// Get table structures
echo "\n\n=== TABLE STRUCTURES ===\n\n";

foreach($tables as $table) {
    $tableName = $table['TABLE_NAME'];
    $columns = $pdo->query("SHOW COLUMNS FROM $tableName")->fetchAll(PDO::FETCH_ASSOC);
    $rows = $pdo->query("SELECT COUNT(*) as count FROM $tableName")->fetch(PDO::FETCH_ASSOC)['count'];
    
    echo "TABLE: $tableName\n";
    echo "  Rows: $rows\n";
    echo "  Columns: " . count($columns) . "\n";
    foreach($columns as $col) {
        echo "    - " . $col['Field'] . " (" . $col['Type'] . ")\n";
    }
    echo "\n";
}

echo "=== READY FOR MIGRATION ===\n";
echo "Database detected and ready for data migration if needed.\n";
