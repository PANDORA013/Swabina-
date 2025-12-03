<?php
/**
 * Test News Store Endpoint
 * Simulates form submission to test the news store functionality
 */

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Berita;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

echo "=== News Store Endpoint Test ===\n\n";

// Get superadmin
$user = User::where('email', 'superadmin@swabinagatra.com')->first();
if (!$user) {
    echo "❌ Superadmin not found!\n";
    exit(1);
}

echo "✓ Found superadmin: {$user->email}\n";
Auth::login($user);

// Create a test image file
$testImagePath = storage_path('test_image.jpg');
if (!file_exists($testImagePath)) {
    // Create a simple test image (1x1 pixel JPG)
    $image = imagecreatetruecolor(100, 100);
    $red = imagecolorallocate($image, 255, 0, 0);
    imagefill($image, 0, 0, $red);
    imagejpeg($image, $testImagePath, 90);
    imagedestroy($image);
    echo "✓ Created test image: {$testImagePath}\n";
}

// Simulate the form request
echo "\n--- Simulating Form Submission ---\n";

$testData = [
    'title' => 'Test Berita - ' . date('H:i:s'),
    'description' => 'Ini adalah test berita untuk verify functionality berita module. Testing dengan debug yang komprehensif.'
];

echo "Test data:\n";
echo "  - Title: {$testData['title']}\n";
echo "  - Description length: " . strlen($testData['description']) . "\n";

// Check storage directory
$storageDir = storage_path('app/public/beritas');
echo "\nStorage directory check:\n";
echo "  - Path: {$storageDir}\n";
echo "  - Exists: " . (is_dir($storageDir) ? 'YES' : 'NO') . "\n";
echo "  - Writable: " . (is_writable($storageDir) ? 'YES' : 'NO') . "\n";

// Check Intervention Image
echo "\nIntervention Image check:\n";
try {
    $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
    echo "  - ImageManager initialized: YES\n";
    echo "  - Driver: GD\n";
} catch (\Exception $e) {
    echo "  - Error: " . $e->getMessage() . "\n";
}

// Test image save
echo "\n--- Testing Image Save Process ---\n";
try {
    $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
    $testImage = $manager->read($testImagePath);
    $testImage->scaleDown(1200);
    
    $fileName = 'test_' . time() . '_' . uniqid() . '.jpg';
    $savePath = $storageDir . '/' . $fileName;
    $testImage->toJpeg(80)->save($savePath);
    
    if (file_exists($savePath)) {
        echo "✓ Image saved successfully!\n";
        echo "  - File: {$fileName}\n";
        echo "  - Size: " . round(filesize($savePath) / 1024, 2) . " KB\n";
        unlink($savePath); // Clean up test file
    } else {
        echo "❌ Image file not found after save!\n";
    }
} catch (\Exception $e) {
    echo "❌ Error saving image: " . $e->getMessage() . "\n";
}

// Test database insert
echo "\n--- Testing Database Insert ---\n";
try {
    $count_before = Berita::count();
    echo "  - Records before: {$count_before}\n";
    
    $test_berita = Berita::create([
        'image' => 'beritas/test_' . time() . '.jpg',
        'title' => $testData['title'],
        'description' => $testData['description']
    ]);
    
    $count_after = Berita::count();
    echo "  - Records after: {$count_after}\n";
    
    if ($count_after > $count_before) {
        echo "✓ Database insert successful!\n";
        echo "  - ID: {$test_berita->id}\n";
        echo "  - Title: {$test_berita->title}\n";
        
        // Delete test record
        $test_berita->delete();
        echo "  - Test record cleaned up\n";
    } else {
        echo "❌ Database insert failed!\n";
    }
} catch (\Exception $e) {
    echo "❌ Error inserting to database: " . $e->getMessage() . "\n";
}

// Check latest logs
echo "\n--- Latest Laravel Logs ---\n";
$logFile = storage_path('logs/laravel.log');
if (file_exists($logFile)) {
    $lines = file($logFile);
    $latest_lines = array_slice($lines, -10);
    foreach ($latest_lines as $line) {
        if (strpos($line, 'Berita') !== false || strpos($line, 'image') !== false) {
            echo trim($line) . "\n";
        }
    }
} else {
    echo "Log file not found\n";
}

echo "\n=== Test Complete ===\n";
echo "\nNext: Try submitting from web interface and check logs!\n";
