<?php
$pdo = new PDO('mysql:host=localhost;dbname=swabina01', 'root', '');
$tables = $pdo->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'swabina01' ORDER BY TABLE_NAME")->fetchAll(PDO::FETCH_ASSOC);

echo "=== DATABASE VERIFICATION ===\n\n";
foreach($tables as $i => $t) {
    echo ($i+1) . ". " . $t['TABLE_NAME'] . "\n";
}
echo "\nTotal: " . count($tables) . " tables\n";
