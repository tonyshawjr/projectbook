<?php

namespace App\Controllers;

use App\Core\Auth;

class AuthController
{
    private $auth;
    
    public function __construct()
    {
        $this->auth = new Auth();
    }
    
    public function showLogin()
    {
        if ($this->auth->isLoggedIn()) {
            header('Location: /dashboard');
            exit;
        }
        
        include APP_PATH . '/Views/auth/login.php';
    }
    
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }
        
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';
        
        if ($this->auth->login($email, $password)) {
            header('Location: /dashboard');
            exit;
        } else {
            $_SESSION['error'] = 'Invalid email or password';
            header('Location: /login');
            exit;
        }
    }
    
    public function logout()
    {
        $this->auth->logout();
        header('Location: /login');
        exit;
    }
}