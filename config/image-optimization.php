<?php

return [
    'image' => [
        // Maximum dimensions for optimization
        'max_width' => 1920,
        'max_height' => 1440,

        // Image quality settings
        'jpeg_quality' => 75,
        'webp_quality' => 75,

        // File size limits (in bytes)
        'max_size' => 2 * 1024 * 1024, // 2MB

        // Allowed MIME types
        'allowed_mimes' => ['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'],

        // Storage path
        'storage_path' => 'uploads',

        // Enable WebP conversion
        'enable_webp' => true,

        // Enable lazy loading
        'enable_lazy_load' => true,

        // Cache optimization results
        'cache_results' => true,
        'cache_ttl' => 86400, // 24 hours
    ],
];
