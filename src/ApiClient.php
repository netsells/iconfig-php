<?php

namespace Netsells\iConfig;

use Http\Client\HttpClient;

class ApiClient
{
    private $apiKey;
    private $apiHost;
    /**
     * @var HttpClient
     */
    private $httpClient;

    public function __construct($apiKey, $apiHost, HttpClient $httpClient = null)
    {

        $this->apiKey = $apiKey;
        $this->apiHost = $apiHost;
        $this->httpClient = $httpClient;
    }
}