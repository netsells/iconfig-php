<?php

namespace Netsells\iConfig;

use Netsells\iConfig\Helpers\Flatten;
use Netsells\iConfig\Http\ApiClient;

class iConfig
{
    const SDK_VERSION = '1.0';
    const SDK_USER_AGENT = 'iconfig-sdk-php';

    protected $apiClient;
    protected $apiId;
    protected $apiSecret;
    protected $apiUserId;

    /**
     * iConfig constructor.
     * @param $apiId
     * @param $apiSecret
     */
    public function __construct($apiId, $apiSecret, $apiUserId, HttpClient $httpClient = null, $apiEndpoint = 'api.iconfig.io')
    {
        $this->apiId = $apiId;
        $this->apiSecret = $apiSecret;
        $this->apiUserId = $apiUserId;
        $this->apiClient = new ApiClient($apiEndpoint, $httpClient);

        $this->fetchAccessToken();
    }

    public function fetchAccessToken()
    {
        $response = $this->apiClient->post('oauth/token', [
            'grant_type' => 'personal_access',
            'client_id' => $this->apiId,
            'client_secret' => $this->apiSecret,
            'user_id' => $this->apiUserId,
        ]);

        $accessToken = $response->getResponseBody()->access_token;
        if ($accessToken) {
            $this->apiClient->setToken($accessToken);
        }
    }

    public function submitConfig(Config $config)
    {
        $flattener = new Flatten;
        $configBody = $flattener->config($config);

        $response = $this->apiClient->post('api/config/create', $configBody);

        return $response->getResponseBody();
    }

    public function sendConfig($configIdentifier, $email)
    {

    }
}