<?php

namespace Netsells\iConfig\Http;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Netsells\iConfig\Http\Exceptions\HTTPException;
use Netsells\iConfig\iConfig;
use Psr\Http\Message\ResponseInterface;

class ApiClient
{
    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $apiHost;

    /**
     * @var HttpClient
     */
    private $httpClient;

    public function __construct($apiHost, HttpClient $httpClient = null)
    {
        $this->httpClient = $httpClient;
        $this->apiHost = $apiHost;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    public function post($endpoint, array $body = [])
    {
        return $this->send('POST', $endpoint, $body);
    }

    protected function send($method, $endpoint, array $body = [], array $headers = [])
    {
        $headers['User-Agent'] = iConfig::SDK_USER_AGENT.'/'.iConfig::SDK_VERSION;

        // We like our json
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';

        if ($this->token) {
            $headers['Authorization'] = "Bearer {$this->token}";
        }

        $request = MessageFactoryDiscovery::find()->createRequest($method, $this->formatApiUrl($endpoint), $headers, $this->prepareBody($body));
        $response = $this->getHttpClient()->sendRequest($request);
        return $this->responseHandler($response);
    }

    public function responseHandler(ResponseInterface $responseObject)
    {
        $response = new Response($responseObject->getStatusCode(), $responseObject->getBody());

        switch ($response->getResponseCode()) {
            case 200:
                return $response;
            case 400:
                throw new HTTPException("400", $response);
            case 401:
                throw new HTTPException("401", $response);
            case 404:
                throw new HTTPException("404", $response);
            case 500:
                throw new HTTPException("500", $response);
            default:
                throw new HTTPException("There was a problem!", $response);
        }
    }

    /**
     * @return HttpClient
     */
    protected function getHttpClient()
    {
        if ($this->httpClient === null) {
            $this->httpClient = HttpClientDiscovery::find();
        }
        return $this->httpClient;
    }

    /**
     * @param $endpoint
     *
     * @return string
     */
    private function formatApiUrl($endpoint)
    {
        // TODO: Restore to https
        return "http://{$this->apiHost}/{$endpoint}";
    }

    private function prepareBody($body)
    {
        return json_encode($body);
    }
}