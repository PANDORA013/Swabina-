<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "\n========================================\n";
echo "🔐 RESET SUPER ADMIN PASSWORD\n";
echo "========================================\n\n";

$email = 'superadmin@swabinagatra.com';
$newPassword = '12345678';

$user = User::where('email', $email)->first();

if (!$user) {
    echo "❌ User not found!\n";
    exit(1);
}

// Update password
$user->update(['password' => Hash::make($newPassword)]);

echo "✅ PASSWORD RESET SUCCESSFUL!\n\n";
echo "========================================\n";
echo "📧 Email: $email\n";
echo "🔑 Password: $newPassword\n";
echo "========================================\n\n";
