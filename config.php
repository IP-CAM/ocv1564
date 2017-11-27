<?php
define('CONFIG_STORE_DOMAIN','www.ocv1564.net');
define('CONFIG_STORE_PATH',dirname(__FILE__));
// HTTP
define('HTTP_SERVER', 'http://'.CONFIG_STORE_DOMAIN.'/');

// HTTPS
define('HTTPS_SERVER', 'http://'.CONFIG_STORE_DOMAIN.'/');

// DIR
define('DIR_APPLICATION', CONFIG_STORE_PATH.'/catalog/');
define('DIR_SYSTEM', CONFIG_STORE_PATH.'/system/');
define('DIR_DATABASE', CONFIG_STORE_PATH.'/system/database/');
define('DIR_LANGUAGE', CONFIG_STORE_PATH.'/catalog/language/');
define('DIR_TEMPLATE', CONFIG_STORE_PATH.'/catalog/view/theme/');
define('DIR_CONFIG', CONFIG_STORE_PATH.'/system/config/');
define('DIR_IMAGE', CONFIG_STORE_PATH.'/image/');
define('DIR_CACHE', CONFIG_STORE_PATH.'/system/cache/');
define('DIR_DOWNLOAD', CONFIG_STORE_PATH.'/download/');
define('DIR_LOGS', CONFIG_STORE_PATH.'/system/logs/');

// DB
define('DB_DRIVER', 'mysql');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'ocv1564');
define('DB_PREFIX', 'oc_');
?>