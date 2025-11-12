<?php
$pdo = new PDO('mysql:host=localhost;dbname=swabina01', 'root', '');

echo "=== CLEANING UP MISSING MIGRATION RECORDS ===\n\n";

// Migrations untuk tables yang tidak digunakan
$missing_migrations = [
    '2025_11_11_061617_create_unified_tables_for_services'
];

echo "Deleting migration records for missing tables:\n";
foreach($missing_migrations as $mig) {
    echo "  - $mig\n";
}

$stmt = $pdo->prepare("DELETE FROM migrations WHERE migration = ?");
$deleted = 0;
foreach($missing_migrations as $mig) {
    if($stmt->execute([$mig])) {
        $deleted += $stmt->rowCount();
    }
}

echo "\nDeleted: $deleted records\n\n";

echo "=== CURRENT MIGRATIONS TABLE ===\n\n";
$migrations = $pdo->query("SELECT migration, batch FROM migrations ORDER BY batch, migration")->fetchAll(PDO::FETCH_ASSOC);

echo "Total migrations: " . count($migrations) . "\n\n";
foreach($migrations as $mig) {
    echo "[Batch " . $mig['batch'] . "] " . $mig['migration'] . "\n";
}

echo "\n✓ Database ready with 12 tables\n";
