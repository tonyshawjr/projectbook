<?php
echo "PHP is working!<br>";
echo "Document root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "Script filename: " . $_SERVER['SCRIPT_FILENAME'] . "<br>";
echo "Current directory: " . __DIR__ . "<br>";

// Check if config exists
$configPath = dirname(__DIR__) . '/config/config.php';
if (file_exists($configPath)) {
    echo "✅ Config file found at: " . $configPath . "<br>";
} else {
    echo "❌ Config file NOT found at: " . $configPath . "<br>";
}

// Check if app folder exists
$appPath = dirname(__DIR__) . '/app';
if (is_dir($appPath)) {
    echo "✅ App folder found<br>";
} else {
    echo "❌ App folder NOT found<br>";
}

phpinfo();