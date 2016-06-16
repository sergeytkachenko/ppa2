<?
namespace PhalconPPA;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

abstract class JsonController extends Controller {

	public function afterExecuteRoute(Dispatcher $dispatcher) {
		$this->view->disable();
		$data = $dispatcher->getReturnedValue();
		$data = $data ? $data : array();
		$data = json_encode($data);
		$this->response->setContentType('application/json', 'UTF-8');
		$this->response->setContent($data);
		$this->response->send();
	}

}