<?php

// Dev
error_reporting(E_ALL);

// Prod
// error_reporting(0);

define('SITE_NAME', 'PHP Blog');

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

// IONOS
// define('DB_HOST', 'db5001918665.hosting-data.io');
// define('DB_PORT', 3306);
// define('DB_NAME', 'dbs1570754');
// define('DB_USER', 'dbu1375636');
// define('DB_PASSWORD', 'PVByb59TTn!_heK');

define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', '0Zc!KhCbpY#S2%zd5&V6');

define('CONTACT_EMAIL', 'lorenzopas@gmail.com');