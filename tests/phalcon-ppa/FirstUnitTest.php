<?

use Phalcon\Http\Client\Request;

class FirstUnitTest extends \UnitTestCase
{
	public function testA() {
		$provider  = Request::getProvider();
		$provider->setBaseUri('/api/ppa/brands');
		$response = $provider->get('me/images', array(
			'access_token' => 1234
		));

		echo $response->body;


		//$this->assertCount(count($users), 20, 'f test');
	}
}