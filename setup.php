<?php
/**
 * Setup script - Generate password hash and test database
 */

echo "<h2>Projectbook Setup Helper</h2>";

// Generate password hash
$password = 'password123';
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "<h3>Password Hash Generator:</h3>";
echo "<p>Password: <code>password123</code></p>";
echo "<p>Hash: <code>" . htmlspecialchars($hash) . "</code></p>";

echo "<h3>SQL to update user password:</h3>";
echo "<pre>";
echo "UPDATE users SET password_hash = '" . $hash . "' WHERE email = 'tony@example.com';";
echo "</pre>";

// Test current hash
$stored_hash = '$2y$10$YNqHb3NhM.KmVJ7pLt.6OugP8Y1bH7mQE.XPpYxq7HZaMnZYLQGrO';
$verify = password_verify($password, $stored_hash);

echo "<h3>Current Hash Test:</h3>";
echo "<p>Testing stored hash: " . ($verify ? "✅ VALID" : "❌ INVALID") . "</p>";

// If config exists, test database
if (file_exists('config/config.php')) {
    require_once 'config/config.php';
    
    echo "<h3>Database Connection Test:</h3>";
    
    try {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        echo "<p>✅ Database connected successfully</p>";
        
        // Check if users table exists
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
        $result = $stmt->fetch();
        echo "<p>Users in database: " . $result['count'] . "</p>";
        
        // Get user details
        $stmt = $pdo->prepare("SELECT id, email, first_name, last_name FROM users WHERE email = ?");
        $stmt->execute(['tony@example.com']);
        $user = $stmt->fetch();
        
        if ($user) {
            echo "<p>✅ User found: " . htmlspecialchars($user['email']) . " (" . htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) . ")</p>";
            
            // Update password to ensure it works
            echo "<h3>Fix Login:</h3>";
            echo "<p>Run this SQL in phpMyAdmin to fix the password:</p>";
            echo "<pre>";
            echo "UPDATE users SET password_hash = '$hash' WHERE id = " . $user['id'] . ";";
            echo "</pre>";
        } else {
            echo "<p>❌ User tony@example.com not found</p>";
            echo "<p>You need to import database/seed.sql first</p>";
        }
        
    } catch (PDOException $e) {
        echo "<p>❌ Database error: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
} else {
    echo "<h3>❌ Config file not found</h3>";
    echo "<p>Create config/config.php with your database settings</p>";
}

echo "<hr>";
echo "<p><strong>After fixing:</strong> Try logging in with email: <code>tony@example.com</code> password: <code>password123</code></p>";
echo "<p><a href='/'>Go to Login</a></p>";
?>