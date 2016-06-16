<?php

$loader = new \Phalcon\Loader();

$loader->registerNamespaces(
	array(
		'Phalcon\Di\Service' => $config->application->servicesDir,
		'Lib' => $config->application->libDir
	)
);
$loader->registerDirs(
	array(
		$config->application->controllersDir,
		$config->application->libraryDir,
		$config->application->libDir,
		$config->application->modelsDir
	)
)->register();
