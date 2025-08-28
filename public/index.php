<?php
/**
 * Projectbook - Entry Point
 * 
 * This is the main entry point for the Projectbook application.
 * All requests are routed through this file.
 */

// Set error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define paths
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('STORAGE_PATH', ROOT_PATH . '/storage');

// Start session
session_start();

// Load configuration
if (file_exists(CONFIG_PATH . '/config.php')) {
    require_once CONFIG_PATH . '/config.php';
} else {
    die('Configuration file not found. Please create config/config.php');
}

// Autoloader (temporary - will be replaced with proper autoloader)
spl_autoload_register(function ($class) {
    $paths = [
        APP_PATH . '/Core/',
        APP_PATH . '/Controllers/',
        APP_PATH . '/Models/',
        APP_PATH . '/Helpers/'
    ];
    
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Initialize application
try {
    // This will be replaced with proper router initialization
    echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Projectbook - Coming Soon</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #f3f4f6;
        }
        .container {
            text-align: center;
            padding: 2rem;
        }
        h1 {
            color: #1e293b;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        p {
            color: #64748b;
            font-size: 1.125rem;
        }
        .badge {
            display: inline-block;
            background: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>Projectbook</h1>
        <p>Freelance Project Management & Billing Dashboard</p>
        <div class='badge'>Coming Soon</div>
    </div>
</body>
</html>";
    
} catch (Exception $e) {
    // Log error and show generic message
    error_log($e->getMessage());
    die('Application error. Please check logs.');
}