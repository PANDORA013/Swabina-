<?php
$pdo = new PDO('mysql:host=localhost;dbname=swabina01', 'root', '');

echo "=== SYNCING MIGRATIONS TABLE ===\n\n";

// Get all migration files
$migrationDir = __DIR__ . '/database/migrations';
$files = glob($migrationDir . '/*.php');

// Extract migration names
$migrations = [];
foreach ($files as $file) {
    $filename = basename($file);
    $name = str_replace('.php', '', $filename);
    $migrations[] = $name;
}

echo "Found " . count($migrations) . " migration files\n\n";

// Insert all migrations into migrations table
$stmt = $pdo->prepare("INSERT INTO migrations (migration, batch) VALUES (?, ?)");

// Check current batch
$result = $pdo->query("SELECT MAX(batch) as max_batch FROM migrations")->fetch(PDO::FETCH_ASSOC);
$batch = ($result['max_batch'] ?? 0) + 1;

$inserted = 0;
foreach ($migrations as $migration) {
    try {
        // Check if migration already exists
        $check = $pdo->prepare("SELECT id FROM migrations WHERE migration = ?");
        $check->execute([$migration]);
        
        if (!$check->fetch()) {
            $stmt->execute([$migration, $batch]);
            $inserted++;
            echo "✓ $migration\n";
        }
    } catch (Exception $e) {
        echo "✗ $migration - " . $e->getMessage() . "\n";
    }
}

echo "\nInserted: $inserted new migration records\n\n";

// Verify
$count = $pdo->query("SELECT COUNT(*) as count FROM migrations")->fetch(PDO::FETCH_ASSOC)['count'];
echo "Total migrations in database: $count\n";

// Now create the why_choose_us table manually
echo "\n=== CREATING why_choose_us TABLE ===\n\n";

try {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `why_choose_us` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` varchar(255) NOT NULL,
            `description` longtext NOT NULL,
            `icon` varchar(255) NULL,
            `image` varchar(255) NULL,
            `order` int NOT NULL DEFAULT 0,
            `status` enum('active','inactive') NOT NULL DEFAULT 'active',
            `created_at` timestamp NULL,
            `updated_at` timestamp NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    echo "✓ why_choose_us table created successfully\n";
} catch (Exception $e) {
    if (strpos($e->getMessage(), 'already exists') !== false) {
        echo "✓ why_choose_us table already exists\n";
    } else {
        echo "✗ Error: " . $e->getMessage() . "\n";
    }
}

// Verify all tables
echo "\n=== FINAL TABLE VERIFICATION ===\n\n";
$tables = $pdo->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'swabina01' ORDER BY TABLE_NAME")->fetchAll(PDO::FETCH_ASSOC);

foreach ($tables as $i => $t) {
    echo ($i+1) . ". " . $t['TABLE_NAME'] . "\n";
}

echo "\nTotal tables: " . count($tables) . "\n";
echo "\n✓ Database sync complete!\n";
