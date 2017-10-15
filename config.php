<?php
$DOMAIN = $_SERVER['HTTP_HOST'];
$PATH = $_SERVER['DOCUMENT_ROOT'];
// HTTP
define('HTTP_SERVER', 'http://'.$DOMAIN.'/');

// HTTPS
define('HTTPS_SERVER', 'http://'.$DOMAIN.'/');

// DIR
define('DIR_APPLICATION', $PATH.'/catalog/');
define('DIR_SYSTEM', $PATH.'/system/');
define('DIR_DATABASE', $PATH.'/system/database/');
define('DIR_LANGUAGE', $PATH.'/catalog/language/');
define('DIR_TEMPLATE', $PATH.'/catalog/view/theme/');
define('DIR_CONFIG', $PATH.'/system/config/');
define('DIR_IMAGE', $PATH.'/image/');
define('DIR_CACHE', $PATH.'/system/cache/');
define('DIR_DOWNLOAD', $PATH.'/download/');
define('DIR_LOGS', $PATH.'/system/logs/');

// DB
define('DB_DRIVER', 'mysql');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'ocv1564');
define('DB_PREFIX', 'oc_');
?>