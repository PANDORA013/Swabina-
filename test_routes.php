<?php

// Load Laravel
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Route;

echo "\n========================================\n";
echo "🔍 CHECKING ROUTES\n";
echo "========================================\n\n";

$routes = Route::getRoutes();

echo "Total routes: " . count($routes) . "\n\n";

echo "Admin Management Routes:\n";
foreach ($routes as $route) {
    if (strpos($route->uri, 'admin/admin-management') !== false) {
        echo "  - " . $route->methods[0] . " " . $route->uri;
        echo " [" . implode(', ', $route->middleware()) . "]\n";
    }
}

echo "\n========================================\n";
echo "🔍 CHECKING MIDDLEWARE\n";
echo "========================================\n\n";

$kernel = app(\App\Http\Kernel::class);
$aliases = $kernel->getRouteMiddleware();

echo "Registered Middleware Aliases:\n";
foreach ($aliases as $name => $class) {
    echo "  - $name => $class\n";
}

echo "\n========================================\n";
echo "✅ VERIFICATION COMPLETE\n";
echo "========================================\n\n";
