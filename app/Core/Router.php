<?php

namespace App\Core;

class Router
{
    private $routes = [];
    private $auth;
    
    public function __construct()
    {
        $this->auth = new Auth();
    }
    
    public function get($path, $handler, $requireAuth = false)
    {
        $this->routes['GET'][$path] = ['handler' => $handler, 'requireAuth' => $requireAuth];
    }
    
    public function post($path, $handler, $requireAuth = false)
    {
        $this->routes['POST'][$path] = ['handler' => $handler, 'requireAuth' => $requireAuth];
    }
    
    public function dispatch($method, $uri)
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = trim($uri, '/');
        
        // Handle empty URI (home page)
        if (empty($uri)) {
            $uri = '/';
        }
        
        // Check for exact match
        if (isset($this->routes[$method][$uri])) {
            $route = $this->routes[$method][$uri];
            
            if ($route['requireAuth'] && !$this->auth->isLoggedIn()) {
                header('Location: /login');
                exit;
            }
            
            return $this->handleRoute($route['handler']);
        }
        
        // Check for pattern match (e.g., /projects/{id})
        foreach ($this->routes[$method] as $pattern => $route) {
            $pattern = str_replace('/', '\/', $pattern);
            $pattern = preg_replace('/\{([a-zA-Z]+)\}/', '(?P<$1>[^/]+)', $pattern);
            $pattern = '/^' . $pattern . '$/';
            
            if (preg_match($pattern, $uri, $matches)) {
                if ($route['requireAuth'] && !$this->auth->isLoggedIn()) {
                    header('Location: /login');
                    exit;
                }
                
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                return $this->handleRoute($route['handler'], $params);
            }
        }
        
        // 404 Not Found
        http_response_code(404);
        include APP_PATH . '/Views/errors/404.php';
    }
    
    private function handleRoute($handler, $params = [])
    {
        if (is_callable($handler)) {
            return call_user_func_array($handler, $params);
        }
        
        if (is_string($handler)) {
            list($controller, $method) = explode('@', $handler);
            $controllerClass = "App\\Controllers\\" . $controller;
            
            if (class_exists($controllerClass)) {
                $controllerInstance = new $controllerClass();
                
                if (method_exists($controllerInstance, $method)) {
                    return call_user_func_array([$controllerInstance, $method], $params);
                }
            }
        }
        
        throw new \Exception('Invalid route handler');
    }
}