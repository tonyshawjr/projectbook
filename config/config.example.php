<?php
/**
 * Projectbook Configuration Example
 * 
 * Copy this file to config.php and update with your settings
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'projectbook');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_CHARSET', 'utf8mb4');

// Application Settings
define('APP_NAME', 'Projectbook');
define('APP_URL', 'http://localhost/projectbook');
define('APP_ENV', 'development'); // development, staging, production

// Session Configuration
define('SESSION_NAME', 'projectbook_session');
define('SESSION_LIFETIME', 7200); // 2 hours

// Security
define('CSRF_TOKEN_NAME', 'csrf_token');
define('PASSWORD_MIN_LENGTH', 8);

// File Upload Settings
define('MAX_FILE_SIZE', 10485760); // 10MB in bytes
define('ALLOWED_FILE_TYPES', ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip']);

// Email Settings (for PHPMailer)
define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_PORT', 587);
define('MAIL_USERNAME', 'your_email@gmail.com');
define('MAIL_PASSWORD', 'your_password');
define('MAIL_FROM_EMAIL', 'noreply@projectbook.com');
define('MAIL_FROM_NAME', 'Projectbook');

// Timezone
date_default_timezone_set('America/New_York');

// Error Reporting
if (APP_ENV === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Stripe Configuration (Phase 2)
// define('STRIPE_PUBLIC_KEY', 'pk_test_...');
// define('STRIPE_SECRET_KEY', 'sk_test_...');
// define('STRIPE_WEBHOOK_SECRET', 'whsec_...');