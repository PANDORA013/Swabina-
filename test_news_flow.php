<?php
/**
 * Test News Submission Flow
 * This script simulates testing the news (berita) submission functionality
 */

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

echo "=== News Submission Flow Test ===\n\n";

// Test 1: Check if superadmin exists
echo "Test 1: Check superadmin user...\n";
$superadmin = User::where('email', 'superadmin@swabinagatra.com')->first();
if ($superadmin) {
    echo "✓ Superadmin found: {$superadmin->email}\n";
    echo "  - ID: {$superadmin->id}\n";
    echo "  - Role: {$superadmin->role}\n";
    echo "  - Is Super Admin: " . ($superadmin->isSuperAdmin() ? 'YES' : 'NO') . "\n";
} else {
    echo "✗ Superadmin not found\n";
}

// Test 2: Check Berita table
echo "\nTest 2: Check Berita table...\n";
try {
    $beritaCount = Berita::count();
    echo "✓ Berita table exists\n";
    echo "  - Total records: {$beritaCount}\n";
    
    if ($beritaCount > 0) {
        $latest = Berita::latest()->first();
        echo "  - Latest: {$latest->title} (ID: {$latest->id})\n";
    }
} catch (\Exception $e) {
    echo "✗ Error accessing Berita table: " . $e->getMessage() . "\n";
}

// Test 3: Check storage directory
echo "\nTest 3: Check storage directory...\n";
$storageDir = storage_path('app/public/beritas');
if (is_dir($storageDir)) {
    echo "✓ Storage directory exists: {$storageDir}\n";
    $files = scandir($storageDir);
    $files = array_diff($files, ['.', '..']);
    echo "  - Files: " . count($files) . "\n";
} else {
    echo "✗ Storage directory does not exist\n";
    echo "  - Path: {$storageDir}\n";
}

// Test 4: Check NewsController
echo "\nTest 4: Check NewsController methods...\n";
$controllerPath = app_path('Http/Controllers/News/NewsController.php');
if (file_exists($controllerPath)) {
    echo "✓ NewsController exists\n";
    
    $content = file_get_contents($controllerPath);
    $hasSto = strpos($content, 'public function store') !== false;
    $hasUpdate = strpos($content, 'public function update') !== false;
    $hasDestroy = strpos($content, 'public function destroy') !== false;
    
    echo "  - store() method: " . ($hasSto ? 'YES' : 'NO') . "\n";
    echo "  - update() method: " . ($hasUpdate ? 'YES' : 'NO') . "\n";
    echo "  - destroy() method: " . ($hasDestroy ? 'YES' : 'NO') . "\n";
} else {
    echo "✗ NewsController not found\n";
}

// Test 5: Check view file
echo "\nTest 5: Check news view file...\n";
$viewPath = resource_path('views/admin/news/index.blade.php');
if (file_exists($viewPath)) {
    echo "✓ News view exists: {$viewPath}\n";
    $size = filesize($viewPath);
    echo "  - Size: " . round($size / 1024, 2) . " KB\n";
} else {
    echo "✗ News view not found\n";
}

echo "\n=== Test Complete ===\n";
echo "\nNext steps:\n";
echo "1. Open http://127.0.0.1:8000/admin/berita in your browser\n";
echo "2. Open DevTools (F12) -> Console tab\n";
echo "3. Try submitting a news item with image, title, and description\n";
echo "4. Check Console logs for debugging information\n";
echo "5. Check Storage -> logs/laravel.log for server-side logs\n";
