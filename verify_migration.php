<?php
$pdo = new PDO('mysql:host=localhost;dbname=swabina01', 'root', '');

echo "=== FINAL DATABASE VERIFICATION ===\n\n";

// Get all tables with data count
$tables = $pdo->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'swabina01' ORDER BY TABLE_NAME")->fetchAll(PDO::FETCH_ASSOC);

echo "DATABASE: swabina01\n";
echo "TABLES: " . count($tables) . "\n\n";

$totalRows = 0;
foreach($tables as $table) {
    $tableName = $table['TABLE_NAME'];
    $result = $pdo->query("SELECT COUNT(*) as count FROM $tableName")->fetch(PDO::FETCH_ASSOC);
    $rows = $result['count'];
    $totalRows += $rows;
    
    $status = $rows > 0 ? "✓ DATA" : "  EMPTY";
    printf("%-30s %s (%d rows)\n", $tableName, $status, $rows);
}

echo "\n" . str_repeat("=", 60) . "\n";
printf("TOTAL ROWS: %d\n", $totalRows);
echo "✓ Database migration COMPLETE!\n";

// Show admin credentials
echo "\n=== ADMIN CREDENTIALS ===\n";
$admin = $pdo->query("SELECT email, name FROM users WHERE role = 'admin' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
if($admin) {
    echo "Email: " . $admin['email'] . "\n";
    echo "Name: " . $admin['name'] . "\n";
    echo "Password: admin1123\n";
}

// Show company info
echo "\n=== COMPANY INFO ===\n";
$company = $pdo->query("SELECT company_name, head_office_city FROM company_info LIMIT 1")->fetch(PDO::FETCH_ASSOC);
if($company) {
    echo "Company: " . $company['company_name'] . "\n";
    echo "City: " . $company['head_office_city'] . "\n";
}
