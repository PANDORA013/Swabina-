<?php
$pdo = new PDO('mysql:host=localhost;dbname=swabina01', 'root', '');

echo "Cleaning up orphaned migration records...\n\n";

$sql = "DELETE FROM migrations WHERE migration IN (
  '2024_09_19_064512_create_sekilas_perusahaans_table',
  '2024_09_19_073535_create_sertifikat_penghargaans_table',
  '2024_10_04_145915_create_m_k_s_table'
)";

$deleted = $pdo->exec($sql);
echo "Deleted: " . $deleted . " orphaned records\n\n";

echo "=== MIGRATIONS AFTER CLEANUP ===\n\n";
$migrations = $pdo->query('SELECT batch, migration FROM migrations ORDER BY batch, migration')->fetchAll();

$currentBatch = 0;
foreach($migrations as $m) {
    if($m['batch'] != $currentBatch) {
        echo "\nBatch " . $m['batch'] . ":\n";
        $currentBatch = $m['batch'];
    }
    echo "  ✓ " . $m['migration'] . "\n";
}

echo "\n\nTotal: " . count($migrations) . " migrations\n";
echo "Status: ✅ CLEAN\n";
