<?php

namespace Autum\SDK\Platform;

use Autum\SDK\Platform\Api\Contacts;
use Autum\SDK\Platform\Api\Notifications;
use Autum\SDK\Platform\Api\Users;
use Hafael\HttpClient\Handler\Curl;
use Hafael\HttpClient\Client as BaseClient;
use Hafael\HttpClient\Contracts\ClientInterface;

/**
 * @method Contacts contacts()
 */
class Client extends BaseClient implements ClientInterface
{
    /**
     * @var string
     */
    const SANDBOX_ENDPOINT = 'https://accounts-dev.autum.com.br/api';

    /**
     * @var string
     */
    const PRODUCTION_ENDPOINT = 'https:/autum.com.br/api';

    /**
     * @var array
     */
    const API_RESOURCES = [
        'contacts'      => Contacts::class,
        'notifications' => Notifications::class,
        'users'         => Users::class,
    ];
    
    /**
     * The client constructor
     * 
     * @param string $apiKey
     * @param string $baseUrl
     */
    public function __construct(string $apiKey, string $baseUrl = self::SANDBOX_ENDPOINT)
    {
        $this->setApiKey($apiKey);
        $this->setBaseUrl($baseUrl);
    }

    /**
     * Preparing request
     * 
     * @param Curl $resource
     * @param array $params
     * @param array $data
     * @param array $headers
     * @return Curl
     */
    public function preRequestScript(Curl $resource, $params = [], $data = [], $headers = [])
    {
        $resource->addHeader('Cache-control: no-cache');
        $resource->addHeader('Content-type: application/json');
        
        //set auth header
        $resource->addHeader('Authorization: Bearer ' . $this->getApiKey());

        return $resource;
    }

}