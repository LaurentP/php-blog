<?php

// Dev
error_reporting(E_ALL);

// Prod
// error_reporting(0);

define('ROOT_DIRECTORY', __DIR__);

// XAMPP
// define('HTTP_HOST', 'localhost/projects/php-blog/public');

// Production et serveur interne de PHP
define('HTTP_HOST', $_SERVER['HTTP_HOST']);

// DEV
define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_NAME', 'php-blog');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', '0Zc!KhCbpY#S2%zd5&V6');

define('SITE_NAME', 'PHP Blog');

define('CONTACT_EMAIL', 'your@email.tld');