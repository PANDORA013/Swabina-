<?php
$pdo = new PDO('mysql:host=localhost;dbname=swabina01', 'root', '');

echo "=== REGISTERING EXISTING TABLES TO MIGRATIONS ===\n\n";

// Step 1: Get all existing tables (except migrations itself)
$tables = $pdo->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME != 'migrations' ORDER BY TABLE_NAME")->fetchAll();

echo "Found " . count($tables) . " existing tables:\n\n";
foreach($tables as $t) {
    echo "  ✓ " . $t['TABLE_NAME'] . "\n";
}

// Step 2: Map existing tables to migration records
// Based on the tables that actually exist in your database
$migrations = [
    // System tables (Batch 1)
    ['migration' => '2014_10_12_000000_create_users_table', 'batch' => 1],
    ['migration' => '2014_10_12_100000_create_password_reset_tokens_table', 'batch' => 1],
    ['migration' => '2019_08_19_000000_create_failed_jobs_table', 'batch' => 1],
    ['migration' => '2019_12_14_000001_create_personal_access_tokens_table', 'batch' => 1],
    
    // Content tables (Batch 2)
    ['migration' => '2024_09_19_071033_create_jejak_langkahs_table', 'batch' => 2],
    ['migration' => '2024_09_19_072923_create_visi_misi_budayas_table', 'batch' => 2],
    ['migration' => '2024_10_05_042010_create_beritas_table', 'batch' => 2],
    ['migration' => '2024_11_06_073616_create_faqs_table', 'batch' => 2],
    ['migration' => '2024_11_10_093803_create_pedomans_table', 'batch' => 2],
    ['migration' => '2024_11_11_create_why_choose_us_table', 'batch' => 2],
    ['migration' => '2024_11_19_060620_create_social_links_table', 'batch' => 2],
    
    // Unified & Company (Batch 3)
    ['migration' => '2025_11_11_061617_create_unified_tables_for_services', 'batch' => 3],
    ['migration' => '2025_11_11_100000_create_company_info_table', 'batch' => 3],
    ['migration' => '2025_11_11_100001_add_linkedin_to_social_links', 'batch' => 3],
];

// Step 3: Insert migration records
echo "\n\nRegistering migrations...\n";
$stmt = $pdo->prepare("INSERT INTO migrations (migration, batch) VALUES (?, ?)");

foreach($migrations as $mig) {
    $stmt->execute([$mig['migration'], $mig['batch']]);
    echo "  ✓ " . $mig['migration'] . " (Batch " . $mig['batch'] . ")\n";
}

echo "\n✅ MIGRATION RECORDS REGISTERED\n\n";

// Step 4: Verify
echo "=== VERIFICATION ===\n\n";
$count = $pdo->query("SELECT COUNT(*) as count FROM migrations")->fetch();
echo "Total migration records: " . $count['count'] . "\n";

$batches = $pdo->query("SELECT batch, COUNT(*) as count FROM migrations GROUP BY batch ORDER BY batch")->fetchAll();
echo "\nMigration Batches:\n";
foreach($batches as $b) {
    echo "  Batch " . $b['batch'] . ": " . $b['count'] . " migrations\n";
}

echo "\n✅ ALL DONE!\n";
echo "Your 15 existing tables are now registered in migrations table.\n";
