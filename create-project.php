<?php
/**
 * Amoeba Framework - Project Creation Script
 * 
 * Script ini dijalankan setelah composer install untuk setup project baru
 */

echo "\n";
echo "╔════════════════════════════════════════════════════╗\n";
echo "║       Amoeba Framework - Project Setup             ║\n";
echo "╚════════════════════════════════════════════════════╝\n";
echo "\n";

// Get project root
$root = getcwd();
$configDir = $root . DIRECTORY_SEPARATOR . 'config';

// Ensure config directory exists
if (!is_dir($configDir)) {
    mkdir($configDir, 0755, true);
    echo "✓ Created config directory\n";
}

// Check if config files already exist
$appConfigExists = file_exists($configDir . DIRECTORY_SEPARATOR . 'app.php');
$dbConfigExists = file_exists($configDir . DIRECTORY_SEPARATOR . 'database.php');

if (!$appConfigExists) {
    // Create default app.php
    $appConfig = <<<'EOD'
<?php

$app_config = array(
    'app_name' => 'Amoeba Project',
    'app_name_first' => 'Amoeba',
    'app_name_last' => 'Project',
    'base_url' => 'http://localhost',
    'default_page' => 'welcome',
    'default_language' => 'en',
    'csrf_key' => 'CHANGE_THIS_TO_RANDOM_STRING_32_CHARS',
    'rewrite' => true,
    'debug' => true,
    'display_errors' => true,
    'log_errors' => true,
    'error_reporting' => E_ALL,
    'show_execution_time' => false,
    'smtp' => array(
        'host' => 'smtp.gmail.com',
        'port' => 587,
        'username' => 'your-email@gmail.com',
        'password' => 'your-password',
        'encryption' => 'tls'
    ),
    'encryption' => array(
        'secret_iv' => 'CHANGE_THIS_TO_16_CHARS',
        'secret_key' => 'CHANGE_THIS_TO_7_CHARS'
    )
);

?>
EOD;

    file_put_contents($configDir . DIRECTORY_SEPARATOR . 'app.php', $appConfig);
    echo "✓ Created config/app.php - Please update with your settings\n";
}

if (!$dbConfigExists) {
    // Create default database.php
    $dbConfig = <<<'EOD'
<?php

$connection = array(
    'default' => array(
        'driver'        => 'mysql',
        'host'          => 'localhost',
        'port'          => '3306',
        'dbname'        => 'amoeba_db',
        'username'      => 'root',
        'password'      => ''
    )
);

?>
EOD;

    file_put_contents($configDir . DIRECTORY_SEPARATOR . 'database.php', $dbConfig);
    echo "✓ Created config/database.php - Please update with your database credentials\n";
}

// Create necessary directories
$dirs = ['components', 'models', 'views', 'middleware', 'helpers', 'public', 'writepath/cache'];

foreach ($dirs as $dir) {
    $dirPath = $root . DIRECTORY_SEPARATOR . $dir;
    if (!is_dir($dirPath)) {
        mkdir($dirPath, 0755, true);
        echo "✓ Created $dir directory\n";
    }
}

// Create .htaccess if not exists
if (!file_exists($root . DIRECTORY_SEPARATOR . '.htaccess')) {
    $htaccess = <<<'EOD'
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php?page=$1 [QSA,L]
</IfModule>
EOD;

    file_put_contents($root . DIRECTORY_SEPARATOR . '.htaccess', $htaccess);
    echo "✓ Created .htaccess file\n";
}

// Create index.php if not exists
if (!file_exists($root . DIRECTORY_SEPARATOR . 'index.php')) {
    $index = <<<'EOD'
<?php
/**
 * Amoeba Framework - Entry Point
 */

define('BASEPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Load framework
require_once(BASEPATH . 'core' . DIRECTORY_SEPARATOR . 'app.php');

// Initialize and run app
$app = new App();
$app->run();
?>
EOD;

    file_put_contents($root . DIRECTORY_SEPARATOR . 'index.php', $index);
    echo "✓ Created index.php file\n";
}

echo "\n";
echo "╔════════════════════════════════════════════════════╗\n";
echo "║            Setup Complete!                         ║\n";
echo "╠════════════════════════════════════════════════════╣\n";
echo "║ Next steps:                                        ║\n";
echo "║ 1. Update config/app.php with your settings       ║\n";
echo "║ 2. Update config/database.php with DB credentials ║\n";
echo "║ 3. Configure your web server document root        ║\n";
echo "║ 4. Start building your application!               ║\n";
echo "╚════════════════════════════════════════════════════╝\n";
echo "\n";
?>
