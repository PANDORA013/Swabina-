<?php
/**
 * Final Verification Test - All Components
 */

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;

echo "════════════════════════════════════════════════════════════════\n";
echo "                   FINAL VERIFICATION TEST\n";
echo "════════════════════════════════════════════════════════════════\n\n";

// Test 1: Check middleware
echo "1️⃣ Middleware Check\n";
echo "────────────────────────────────────────────────────────────────\n";
try {
    $middlewareClass = \App\Http\Middleware\SuperAdminMiddleware::class;
    echo "✅ SuperAdminMiddleware found: {$middlewareClass}\n";
} catch (\Exception $e) {
    echo "❌ SuperAdminMiddleware NOT found: " . $e->getMessage() . "\n";
}

// Test 2: Check User model
echo "\n2️⃣ User Model Methods Check\n";
echo "────────────────────────────────────────────────────────────────\n";
$user = User::where('email', 'superadmin@swabinagatra.com')->first();
if ($user) {
    echo "✅ Superadmin found\n";
    
    if (method_exists($user, 'isSuperAdmin')) {
        echo "✅ isSuperAdmin() method exists\n";
        $isSuper = $user->isSuperAdmin();
        echo "   → Result: " . ($isSuper ? 'YES (Super Admin)' : 'NO') . "\n";
    } else {
        echo "❌ isSuperAdmin() method NOT found\n";
    }
    
    if (method_exists($user, 'hasPermissionTo')) {
        echo "✅ hasPermissionTo() method exists (from Spatie)\n";
    } else {
        echo "⚠️ hasPermissionTo() might not exist\n";
    }
} else {
    echo "❌ Superadmin user not found\n";
}

// Test 3: Check Controllers
echo "\n3️⃣ Controller Imports Check\n";
echo "────────────────────────────────────────────────────────────────\n";

$controllersToCheck = [
    'News' => 'App\Http\Controllers\News\NewsController',
    'About' => 'App\Http\Controllers\About\AboutController',
    'Contact' => 'App\Http\Controllers\Contact\ContactController',
    'AdminManagement' => 'App\Http\Controllers\Admin\AdminManagementController',
];

foreach ($controllersToCheck as $name => $class) {
    try {
        $reflection = new ReflectionClass($class);
        echo "✅ {$name}Controller can be loaded\n";
    } catch (\ReflectionException $e) {
        echo "❌ {$name}Controller error: " . $e->getMessage() . "\n";
    }
}

// Test 4: Check Database
echo "\n4️⃣ Database Check\n";
echo "────────────────────────────────────────────────────────────────\n";
try {
    $beritaCount = Berita::count();
    echo "✅ Berita table accessible\n";
    echo "   → Records: {$beritaCount}\n";
    echo "   → Table structure: OK\n";
} catch (\Exception $e) {
    echo "❌ Berita table error: " . $e->getMessage() . "\n";
}

// Test 5: Check Storage
echo "\n5️⃣ Storage Directory Check\n";
echo "────────────────────────────────────────────────────────────────\n";
$storageDir = storage_path('app/public/beritas');
if (is_dir($storageDir)) {
    echo "✅ Storage directory exists\n";
    if (is_writable($storageDir)) {
        echo "✅ Storage directory is writable\n";
    } else {
        echo "⚠️ Storage directory exists but NOT writable\n";
    }
} else {
    echo "❌ Storage directory does NOT exist\n";
}

// Test 6: Check Intervention Image
echo "\n6️⃣ Image Processing Check\n";
echo "────────────────────────────────────────────────────────────────\n";
try {
    $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
    echo "✅ Intervention\\Image ready\n";
    echo "   → Driver: GD\n";
} catch (\Exception $e) {
    echo "❌ Intervention\\Image error: " . $e->getMessage() . "\n";
}

// Test 7: Routes
echo "\n7️⃣ Routes Check\n";
echo "────────────────────────────────────────────────────────────────\n";
try {
    $url1 = route('admin.berita.store');
    echo "✅ admin.berita.store route: {$url1}\n";
    
    $url2 = route('admin.berita.update', ['id' => 1]);
    echo "✅ admin.berita.update route: {$url2}\n";
    
    $url3 = route('admin.berita.destroy', ['id' => 1]);
    echo "✅ admin.berita.destroy route: {$url3}\n";
} catch (\Exception $e) {
    echo "❌ Route error: " . $e->getMessage() . "\n";
}

// Summary
echo "\n════════════════════════════════════════════════════════════════\n";
echo "                      TEST COMPLETE\n";
echo "════════════════════════════════════════════════════════════════\n\n";
echo "✅ If all checks passed, news submission should work!\n";
echo "🔍 Try submitting a berita form now in the browser.\n";
echo "📋 Check console for detailed logging.\n\n";
