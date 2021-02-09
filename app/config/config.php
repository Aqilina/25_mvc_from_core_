<?php
// DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'copied_mvc_from_core');

// aprrot wil be used when we need absloute path to our app dir
define('APPROOT', dirname(dirname(__FILE__)));
//g.b. dirname(__DIR__)

// URL ROOT will be the path in the url
define('URLROOT', 'http://localhost/php/25_mvc_from_core');

// Site name 
define('SITENAME', 'From Core');

//app version
define("APPVERSION", "1.0.0");
// need to change .htaccess in public
// RewriteBase /__YOUR_SITE_DIR__/public
// replace  __YOUR_SITE_DIR__ with root dir name of your site 


//25_mvc_from_core