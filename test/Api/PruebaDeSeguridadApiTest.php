<?php
namespace APIHub\Client;

class PruebaDeSeguridadApiTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $password = getenv('KEY_PASSWORD');
        $this->signer = new \APIHub\Client\Interceptor\KeyHandler(null, null, $password);
        $events = new \APIHub\Client\Interceptor\MiddlewareEvents($this->signer);
        $handler = \GuzzleHttp\HandlerStack::create();
        $handler->push($events->add_signature_header('x-signature'));
        $handler->push($events->verify_signature_header('x-signature'));

        $client = new \GuzzleHttp\Client(['handler' => $handler]);
        $this->apiInstance = new \APIHub\Client\Api\PruebaDeSeguridadApi($client);
    }

    public function testSecurityTest()
    {
        $x_api_key = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
        $body = "Esto es un mensaje de prueba";

        try {
            $result = $this->apiInstance->securityTest($x_api_key, $body);
            $this->signer->close();
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling PruebaDeSeguridadApi->securityTest: ', $e->getMessage(), PHP_EOL;
        }
    }
}
