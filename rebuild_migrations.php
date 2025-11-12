<?php
$pdo = new PDO('mysql:host=localhost;dbname=swabina01', 'root', '');

echo "=== REBUILDING MIGRATIONS TABLE ===\n\n";

// Step 1: Get all active tables
$tables = $pdo->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME != 'migrations' ORDER BY TABLE_NAME")->fetchAll();

echo "Active tables found: " . count($tables) . "\n\n";
foreach($tables as $t) {
    echo "  - " . $t['TABLE_NAME'] . "\n";
}

// Step 2: Clear migrations table
echo "\nClearing migrations table...\n";
$pdo->exec("DELETE FROM migrations");

// Step 3: Map tables to migrations
// Based on the actual tables that exist
$migrations = [
    // System tables (Laravel core)
    ['migration' => '2014_10_12_000000_create_users_table', 'batch' => 1],
    ['migration' => '2014_10_12_100000_create_password_reset_tokens_table', 'batch' => 1],
    ['migration' => '2019_08_19_000000_create_failed_jobs_table', 'batch' => 1],
    ['migration' => '2019_12_14_000001_create_personal_access_tokens_table', 'batch' => 1],
    
    // User modifications
    ['migration' => '2024_09_18_004330_add_role_to_users_table', 'batch' => 1],
    ['migration' => '2024_09_18_020514_add_remember_token_to_users_table', 'batch' => 1],
    
    // Content tables
    ['migration' => '2024_09_19_071033_create_jejak_langkahs_table', 'batch' => 2],
    ['migration' => '2024_09_19_072923_create_visi_misi_budayas_table', 'batch' => 2],
    ['migration' => '2024_10_05_042010_create_beritas_table', 'batch' => 2],
    ['migration' => '2024_11_06_073616_create_faqs_table', 'batch' => 2],
    ['migration' => '2024_11_10_093803_create_pedomans_table', 'batch' => 2],
    ['migration' => '2024_11_11_create_why_choose_us_table', 'batch' => 2],
    
    // Service & Social
    ['migration' => '2024_11_19_060620_create_social_links_table', 'batch' => 2],
    
    // Unified tables
    ['migration' => '2025_11_11_061617_create_unified_tables_for_services', 'batch' => 3],
    
    // Company info
    ['migration' => '2025_11_11_100000_create_company_info_table', 'batch' => 3],
    ['migration' => '2025_11_11_100001_add_linkedin_to_social_links', 'batch' => 3],
];

// Step 4: Insert clean migrations
echo "\nInserting clean migration records...\n";
$stmt = $pdo->prepare("INSERT INTO migrations (migration, batch) VALUES (?, ?)");

foreach($migrations as $mig) {
    $stmt->execute([$mig['migration'], $mig['batch']]);
    echo "  ✓ " . $mig['migration'] . "\n";
}

echo "\n✅ MIGRATIONS REBUILDED\n\n";

// Step 5: Verify
echo "=== VERIFICATION ===\n\n";
$result = $pdo->query("SELECT batch, COUNT(*) as count FROM migrations GROUP BY batch ORDER BY batch")->fetchAll();
echo "Migration Batches:\n";
foreach($result as $r) {
    echo "  Batch " . $r['batch'] . ": " . $r['count'] . " migrations\n";
}

$total = $pdo->query("SELECT COUNT(*) as count FROM migrations")->fetch();
echo "\nTotal migrations: " . $total['count'] . "\n";

echo "\n✅ STATUS: CLEAN & READY\n";
echo "Active tables: " . count($tables) . "\n";
echo "Migration records: " . $total['count'] . "\n";
