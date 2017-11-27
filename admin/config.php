<?php
define('CONFIG_ADMIN_DOMAIN','www.ocv1564.net');
define('CONFIG_ADMIN_PATH',dirname(dirname(__FILE__)));
// HTTP
define('HTTP_SERVER', 'http://'.CONFIG_ADMIN_DOMAIN.'/admin/');
define('HTTP_CATALOG', 'http://'.CONFIG_ADMIN_DOMAIN.'/');

// HTTPS
define('HTTPS_SERVER', 'http://'.CONFIG_ADMIN_DOMAIN.'/admin/');
define('HTTPS_CATALOG', 'http://'.CONFIG_ADMIN_DOMAIN.'/');

// DIR
define('DIR_APPLICATION', CONFIG_ADMIN_PATH.'/admin/');
define('DIR_SYSTEM', CONFIG_ADMIN_PATH.'/system/');
define('DIR_DATABASE', CONFIG_ADMIN_PATH.'/system/database/');
define('DIR_LANGUAGE', CONFIG_ADMIN_PATH.'/admin/language/');
define('DIR_TEMPLATE', CONFIG_ADMIN_PATH.'/admin/view/template/');
define('DIR_CONFIG', CONFIG_ADMIN_PATH.'/system/config/');
define('DIR_IMAGE', CONFIG_ADMIN_PATH.'/image/');
define('DIR_CACHE', CONFIG_ADMIN_PATH.'/system/cache/');
define('DIR_DOWNLOAD', CONFIG_ADMIN_PATH.'/download/');
define('DIR_LOGS', CONFIG_ADMIN_PATH.'/system/logs/');
define('DIR_CATALOG', CONFIG_ADMIN_PATH.'/catalog/');

// DB
define('DB_DRIVER', 'mysql');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'ocv1564');
define('DB_PREFIX', 'oc_');
?>