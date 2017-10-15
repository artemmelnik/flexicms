<?php

// Some standard defines
define('FLEXI_EXEC', true); // In the future in files defined('FLEXI_EXEC') or die('Restricted access!')
define('FLEXI_VERSION', '0.0.1');
define('DS', '/');

define('FLEXI_PHP_MIN', '5.4.0');

// Directories and Paths
define('ROOT_DIR', str_replace(DIRECTORY_SEPARATOR, DS, getcwd()));
