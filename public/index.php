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

// Autoloader
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    $class = str_replace('App/', '', $class);
    
    $paths = [
        APP_PATH . '/',
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
    $router = new App\Core\Router();
    $auth = new App\Core\Auth();
    
    // Public routes
    $router->get('/', function() use ($auth) {
        if ($auth->isLoggedIn()) {
            header('Location: /dashboard');
        } else {
            header('Location: /login');
        }
    });
    
    $router->get('login', 'AuthController@showLogin');
    $router->post('login', 'AuthController@login');
    $router->get('logout', 'AuthController@logout');
    
    // Protected routes
    $router->get('dashboard', 'DashboardController@index', true);
    $router->get('projects', 'ProjectController@index', true);
    $router->get('projects/{id}', 'ProjectController@show', true);
    $router->get('clients', 'ClientController@index', true);
    $router->get('clients/{id}', 'ClientController@show', true);
    $router->get('agencies', 'AgencyController@index', true);
    $router->get('agencies/{id}', 'AgencyController@show', true);
    $router->get('tickets', 'TicketController@index', true);
    $router->get('tickets/{id}', 'TicketController@show', true);
    
    // Dispatch the request
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];
    $router->dispatch($method, $uri);
    
} catch (Exception $e) {
    // Log error and show generic message
    error_log($e->getMessage());
    die('Application error. Please check logs.');
}