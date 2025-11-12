<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

echo "\n========================================\n";
echo "🔍 CHECK SUPER ADMIN ACCOUNT\n";
echo "========================================\n\n";

$user = User::where('email', 'superadmin@swabinagatra.com')->first();

if (!$user) {
    echo "❌ User not found in database!\n";
    exit(1);
}

echo "✅ User Found:\n";
echo "   ID: {$user->id}\n";
echo "   Name: {$user->name}\n";
echo "   Email: {$user->email}\n";
echo "   Password Hash: {$user->password}\n";
echo "   Roles: " . implode(', ', $user->getRoleNames()->toArray()) . "\n";
echo "   Created: {$user->created_at}\n\n";

// Check if password is correct
$testPassword = 'SuperAdmin@2025';
if (password_verify($testPassword, $user->password)) {
    echo "✅ Password verification: CORRECT\n";
} else {
    echo "❌ Password verification: INCORRECT\n";
}

echo "\n========================================\n";
