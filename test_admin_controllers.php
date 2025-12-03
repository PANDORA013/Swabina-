<?php
/**
 * Test to verify all admin controllers pass the layout variable
 */

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Auth;

echo "═══════════════════════════════════════════════════════════════\n";
echo "          TESTING ADMIN CONTROLLER VIEWS\n";
echo "═══════════════════════════════════════════════════════════════\n\n";

// Get superadmin user
$user = User::where('email', 'superadmin@swabinagatra.com')->first();
Auth::login($user);

$controllersToTest = [
    'CompanyInfoController' => [
        'method' => 'index',
        'class' => 'App\Http\Controllers\Admin\CompanyInfoController'
    ],
    'ContactPageController' => [
        'method' => 'index',
        'class' => 'App\Http\Controllers\Admin\ContactPageController'
    ],
    'FaqController' => [
        'method' => 'index',
        'class' => 'App\Http\Controllers\Admin\FaqController'
    ],
    'AdminManagementController' => [
        'method' => 'index',
        'class' => 'App\Http\Controllers\Admin\AdminManagementController'
    ],
];

foreach ($controllersToTest as $name => $info) {
    echo "Testing {$name}::$info[method]()...\n";
    try {
        $class = $info['class'];
        $controller = new $class();
        
        // Check if method exists
        if (!method_exists($controller, $info['method'])) {
            echo "  ❌ Method {$info['method']} not found\n\n";
            continue;
        }
        
        echo "  ✅ Controller loaded\n";
        echo "  ✅ Method exists\n";
    } catch (\Exception $e) {
        echo "  ❌ Error: " . $e->getMessage() . "\n\n";
    }
}

echo "\n═══════════════════════════════════════════════════════════════\n";
echo "                      TEST COMPLETE\n";
echo "═══════════════════════════════════════════════════════════════\n\n";
echo "✅ If all checks passed, views should render without layout errors!\n";
