<?php

use Phalcon\Di;
use Phalcon\Di\FactoryDefault;
use Phalcon\Http\Client\Request;
use Phalcon\Test\UnitTestCase as PhalconTestCase;

abstract class UnitTestCase extends PhalconTestCase
{
	/**
	 * @var \Voice\Cache
	 */
	protected $_cache;

	/**
	 * @var \Phalcon\Config
	 */
	protected $_config;

	/**
	 * @var bool
	 */
	private $_loaded = false;
	/**
	 * @var \Phalcon\Http\Client\Provider\Curl
	 */
	protected $provider;

	protected $baseUri = 'http://ppa-server/api/ppa2';

	public function setUp()
	{
		parent::setUp();

		$this->provider = Request::getProvider();

		$di = new FactoryDefault();
		Di::reset();

		Di::setDefault($di);

		$this->setDi($di);

		$this->_loaded = true;
	}

	/**
	 * Проверка на то, что тест правильно настроен
	 *
	 * @throws \PHPUnit_Framework_IncompleteTestError;
	 */
	public function __destruct()
	{
		if (!$this->_loaded) {
			throw new \PHPUnit_Framework_IncompleteTestError('Please run parent::setUp().');
		}
	}
}