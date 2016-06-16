<?

try {
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	define('PUBLIC_PATH', realpath(dirname(__FILE__)));
	define('API_PATH', realpath(PUBLIC_PATH . '/..'));
	define('APP_PATH', realpath(API_PATH . '/app'));

	/**
	 * Read the configuration
	 */

	$config = include __DIR__ . "/../app/config/config.php";
	include __DIR__ . "/../app/config/debug.php";
	/**
	 * Read auto-loader
	 */
	include __DIR__ . "/../app/config/loader.php";
	include __DIR__ . "/../vendor/autoload.php";

	require_once __DIR__ . "/../app/config/define.php";
	/**
	 * Read services
	 */
	include __DIR__ . "/../app/config/services.php";


	/**
	 * Handle the request
	 */
	$application = new \Phalcon\Mvc\Application($di);

	$application->registerModules(
		array(
			'frontend'  => array(
				'className' => 'Multiple\Frontend\Module',
				'path'      => '../app/frontend/Module.php',
			),
			'methodist' => array(
				'className' => 'Multiple\Methodist\Module',
				'path'      => '../app/methodist/Module.php',
			),
			'student'   => array(
				'className' => 'Multiple\Student\Module',
				'path'      => '../app/student/Module.php',
			),
			'crud'      => array(
				'className' => 'Multiple\Crud\Module',
				'path'      => '../app/crud/Module.php',
			),
			'ppa'      => array(
				'className' => 'Multiple\PPA\Module',
				'path'      => '../app/ppa/Module.php',
			),
			'reports'  => array(
				'className' => 'Multiple\Reports\Module',
				'path'      => '../app/reports/Module.php',
			)
		)
	);

	echo $application->handle()->getContent();

} catch (\Exception $e) {
	echo $e->getMessage();
}
