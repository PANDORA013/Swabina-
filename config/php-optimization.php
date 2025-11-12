<?php

/**
 * PHP Performance Optimization Configuration
 * 
 * Add these directives to php.ini or use ini_set() for production optimization
 * 
 * Location: config/php-optimization.php
 */

return [
    /**
     * OPcache Settings (Code Caching)
     * Dramatically improves PHP performance by caching compiled code
     */
    'opcache' => [
        // Enable opcache
        'enable' => true,
        
        // Enable for CLI (useful for artisan commands)
        'enable_cli' => true,
        
        // Memory allocation for OPcache in MB
        'memory_consumption' => 128,
        
        // Size of interned strings buffer
        'interned_strings_buffer' => 16,
        
        // Maximum number of cached files
        'max_accelerated_files' => 10000,
        
        // Revalidate frequency (0 = check on every request, best for production)
        'revalidate_freq' => 0,
        
        // Validate timestamps
        'validate_timestamps' => false, // Set to true for development
        
        // Fast shutdown
        'fast_shutdown' => true,
        
        // Optimize for negative wasted memory
        'optimization_level' => 0x7FFEBFFF,
    ],

    /**
     * Session Handler Optimization
     * Use native serialization for speed
     */
    'session' => [
        // Use native PHP sessions (fast)
        'serialize_handler' => 'php',
        
        // Cache session data
        'cache_limiter' => 'public',
    ],

    /**
     * Output Buffering
     * Improves compression and performance
     */
    'output' => [
        // Enable output buffering
        'buffering' => true,
        
        // Buffer size in bytes (4MB)
        'handler' => 'ob_gzhandler',
    ],

    /**
     * Error Handling
     * Minimize overhead in production
     */
    'error' => [
        // Display errors off in production
        'display_errors' => false,
        
        // Log errors instead
        'log_errors' => true,
        
        // Error reporting level
        'error_reporting' => E_ALL & ~E_DEPRECATED & ~E_STRICT,
    ],

    /**
     * Memory Management
     * Configure memory limits
     */
    'memory' => [
        // Memory limit per script (512MB)
        'limit' => '512M',
        
        // Maximum post size
        'post_max_size' => '100M',
        
        // Maximum upload size
        'upload_max_filesize' => '100M',
    ],

    /**
     * Timeout Settings
     * Prevent long-running scripts
     */
    'timeout' => [
        // Max execution time (seconds)
        'max_execution_time' => 300,
        
        // Input time limit
        'max_input_time' => 60,
    ],
];
