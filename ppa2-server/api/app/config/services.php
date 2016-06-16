<?php

use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

$di->set('config', function () use ($config) {
	return $config;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
	$url = new UrlResolver();
	$url->setBaseUri($config->application->baseUri);
	return $url;
}, true);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use ($config) {
	$adapter = new \Phalcon\Db\Adapter\Pdo\Mysql(array(
		'host'     => $config->database->mysql->host,
		'username' => $config->database->mysql->username,
		'password' => $config->database->mysql->password,
		'dbname'   => $config->database->mysql->dbname,
		"charset"  => $config->database->mysql->charset
	));
	$adapter->getInternalHandler()->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
    return $adapter;
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () {
	return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function () use ($config) {
	$session = new SessionAdapter();
	$session->start();

	return $session;
});

// Специфичные роуты для модуля
$di->set('router', function () {

	$router = new \Phalcon\Mvc\Router();

	$router->setDefaultModule("frontend");

	$router->add("/login", array(
		'module'     => 'frontend',
		'controller' => 'index',
		'action'     => 'login'
	));
	$router->add("/ppa/[a-zA-Z0-9/]+", array(
		'module'     => 'ppa',
		'controller' => 'base',
		'action'     => 'crud'
	));
	$router->add("/ppa2/[a-zA-Z0-9/]+", array(
		'module'     => 'ppa2',
		'controller' => 'base',
		'action'     => 'crud'
	));
	return $router;
});

$di->set('view', function () use ($config) {
	$view = new View();
	$view->registerEngines(array(
		'.volt'  => function ($view, $di) use ($config) {
			$volt = new VoltEngine($view, $di);
			$volt->setOptions(array(
				'compiledPath'      => $config->application->cacheDir,
				'compiledSeparator' => '_',
				'stat'              => true,
				'compileAlways'     => true
			));
			return $volt;
		},
		'.phtml' => 'Phalcon\Mvc\View\Engine\Php'
	));
	return $view;
}, true);
