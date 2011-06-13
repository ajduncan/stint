<?php

namespace Stint;

define('__BASE_PATH', realpath('../') . '/');
define('__CORE_PATH', __BASE_PATH . 'core/');
define('__APPL_PATH', __BASE_PATH . 'application/');

define('APPLICATION_NAME', 'StintFramework');
define('ROOT_DIRECTORY', getcwd());
define('SITE_NAME', $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']));
define('REF_SITE', 'http://' . SITE_NAME . '/');

require_once(__CORE_PATH . 'classes/index.class.php');
$index = new Index();
$index->Start();

?>
