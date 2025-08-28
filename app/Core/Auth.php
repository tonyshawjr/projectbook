<?php

namespace App\Core;

class Auth
{
    private $db;
    
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    
    public function login($email, $password)
    {
        $user = $this->db->fetch(
            "SELECT * FROM users WHERE email = ? AND is_active = 1",
            [$email]
        );
        
        if ($user && password_verify($password, $user['password_hash'])) {
            $this->createSession($user);
            $this->updateLastLogin($user['id']);
            return true;
        }
        
        return false;
    }
    
    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
    }
    
    public function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }
    
    public function getUser()
    {
        if (!$this->isLoggedIn()) {
            return null;
        }
        
        return $this->db->fetch(
            "SELECT * FROM users WHERE id = ?",
            [$_SESSION['user_id']]
        );
    }
    
    public function requireAuth()
    {
        if (!$this->isLoggedIn()) {
            header('Location: /login');
            exit;
        }
    }
    
    private function createSession($user)
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        session_regenerate_id(true);
    }
    
    private function updateLastLogin($userId)
    {
        $this->db->query(
            "UPDATE users SET last_login_at = NOW() WHERE id = ?",
            [$userId]
        );
    }
    
    public function getCsrfToken()
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    public function verifyCsrfToken($token)
    {
        return isset($_SESSION['csrf_token']) && 
               hash_equals($_SESSION['csrf_token'], $token);
    }
}