<?php
namespace Album\Api;
class SomeApiService
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Zend\Http\Client();
        $adapter = new Zend\Http\Client\Adapter\Curl;
        $adapter->setOptions(array(CURLOPT_FOLLOWLOCATION => true));
        $client->setAdapter($adapter);

    }
...
    public function send(SomeApi $api)
    {

        $this->httpClient->setRawBody($api); //calls $api::__toString()
        $response = $this->httpClient->send();

        return new Response($response->getBody());
    }
...
}

//Create an instance of our SomeApiService class
$service = new SomeApiService();
$response = $service->send($api);