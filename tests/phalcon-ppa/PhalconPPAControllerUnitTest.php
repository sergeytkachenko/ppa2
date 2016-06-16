<?

class PhalconPPAControllerUnitTest extends \UnitTestCase
{
	public function testBaseResponse() {
		$response = $this->provider->get($this->baseUri . '/users');
		$contentType = $response->header->get('Content-Type');
		$data = json_decode($response->body);
		$this->assertContains('application/json', $contentType, 'response type is application/json');
		$this->assertContains('200', $response->header->status, 'returns 200 status');
		$this->assertNotEmpty($data, 'returns not empty data response');
	}
}