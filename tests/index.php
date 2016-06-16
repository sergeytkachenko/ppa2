<?php


ini_set('display_errors',1);
error_reporting(E_ALL);

define('ROOT_PATH', __DIR__);
define('PATH_LIBRARY', __DIR__ . '/../src/');

set_include_path(
	ROOT_PATH . PATH_SEPARATOR . get_include_path()
);

include __DIR__ . "/../vendor/autoload.php";

$loader = new \Phalcon\Loader();

$loader->registerDirs(
	array(
		ROOT_PATH,
		PATH_LIBRARY
	)
);

$loader->register();
