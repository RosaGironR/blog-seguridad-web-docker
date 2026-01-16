<?php
define('DB_HOST', getenv('DB_HOST') ?: 'db');
define('DB_NAME', getenv('DB_NAME') ?: 'blog_db');
define('DB_USER', getenv('DB_USER') ?: 'blog_user');
define('DB_PASS', getenv('DB_PASS') ?: 'blog_password123');
define('DB_CHARSET', 'utf8mb4');

date_default_timezone_set('America/New_York');

ini_set('display_errors', 0);
error_reporting(E_ALL);
