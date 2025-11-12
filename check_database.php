<?php
$pdo = new PDO('mysql:host=localhost;dbname=swabina01', 'root', '');
$stmt = $pdo->query('SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME');
$tables = $stmt->fetchAll();

echo "=== DATABASE TABLES ===\n\n";
foreach($tables as $table) {
    echo $table['TABLE_NAME'] . "\n";
}
echo "\nTotal: " . count($tables) . " tables\n";

echo "\n=== MIGRATION TABLE STATUS ===\n\n";
$migrations = $pdo->query('SELECT * FROM migrations ORDER BY migration')->fetchAll();
echo "Total migrations recorded: " . count($migrations) . "\n\n";
foreach($migrations as $mig) {
    echo "[Batch " . $mig['batch'] . "] " . $mig['migration'] . "\n";
}
