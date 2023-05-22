<?php

namespace Autum\SDK\Platform;

use Autum\SDK\Platform\Api\Contacts;
use Autum\SDK\Platform\Api\Notifications;
use Autum\SDK\Platform\Api\Teams;
use Autum\SDK\Platform\Api\Users;
use Hafael\HttpClient\Handler\Curl;
use Hafael\HttpClient\Client as BaseClient;
use Hafael\HttpClient\Contracts\ClientInterface;
use Hafael\HttpClient\Contracts\RouteInterface;
use Hafael\HttpClient\Exceptions\ClientException;


class Client extends BaseClient implements ClientInterface
{
    /**
     * @var string
     */
    protected $environment;

    /**
     * @var string
     */
    protected $resourceName;

    /**
     * @var string
     */
    const ENV_LOCAL = 'local';

    /**
     * @var string
     */
    const ENV_SANDBOX = 'development';

    /**
     * @var string
     */
    const ENV_PRODUCTION = 'production';

    /**
     * @var array
     */
    const LOCAL_ENDPOINTS = [
        'users'         => 'https://accounts-local.autum.com.br/api/',
        'teams'         => 'https://accounts-local.autum.com.br/api/',
        'notifications' => 'https://accounts-local.autum.com.br/api/',
        'contacts'      => 'https://agenda-local.autum.com.br/api/',
    ];

    /**
     * @var array
     */
    const SANDBOX_ENDPOINTS = [
        'users'         => 'https://accounts-dev.autum.com.br/api/',
        'teams'         => 'https://accounts-dev.autum.com.br/api/',
        'notifications' => 'https://accounts-dev.autum.com.br/api/',
        'contacts'      => 'https://agenda-dev.autum.com.br/api/',
    ];

    /**
     * @var array
     */
    const PRODUCTION_ENDPOINTS = [
        'users'         => 'https://autum.com.br/api/',
        'teams'         => 'https://autum.com.br/api/',
        'notifications' => 'https://autum.com.br/api/',
        'contacts'      => 'https://agenda.autum.com.br/api/',
    ];

    /**
     * @var array
     */
    const API_RESOURCES = [
        'contacts'      => Contacts::class,
        'notifications' => Notifications::class,
        'users'         => Users::class,
        'teams'         => Teams::class,
    ];
    
    /**
     * The client constructor
     * 
     * @param string $apiKey
     * @param string $environment
     */
    public function __construct(string $apiKey, string $environment = self::ENV_PRODUCTION)
    {
        $this->setApiKey($apiKey);
        $this->setEnv($environment);
    }

    /**
     * @return Client
     */
    public function setEnv(string $environment)
    {
        $this->environment = $environment;
        return $this;
    }

    /**
     * @return string
     */
    public function getEnv()
    {
        return $this->environment;
    }

    /**
     * @return Client
     */
    public function setResourceName(string $resourceName)
    {
        $this->resourceName = $resourceName;
        return $this;
    }

    /**
     * @return string
     */
    public function getResourceName()
    {
        return $this->resourceName;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        if($this->getEnv() === 'local') {
            return self::LOCAL_ENDPOINTS[$this->getResourceName()];
        }else if($this->getEnv() === 'development')
        {
            return self::SANDBOX_ENDPOINTS[$this->getResourceName()];
        }
        return self::PRODUCTION_ENDPOINTS[$this->getResourceName()];
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

    /**
     * Preparing request
     * 
     * @param RouteInterface $route
     * @param $method
     * @param array $params
     * @param array $data
     * @param array $headers
     * @return Curl
     */
    public function buildRequest(RouteInterface $route, $method, $params = [], $data = [], $headers = [])
    {
        $resource = new Curl();
        $resource->setMethod($method);
        $query = $this->query($params);

        $url = sprintf('%s%s%s', $this->getBaseUrl(), $route->build(), $query);
        $resource->setUrl($url);

        $this->preRequestScript($resource, $params, $data, $headers);

        if(!empty($data)) {
            $resource->setBody($data);
        }

        if(!empty($headers))
        {
            $resource->addHeaders($headers);
        }

        $resource->setDebugMode($this->getDebugMode());

        return $resource;
    }

    /**
     * Magic methods
     * 
     * @param $name
     * @return mixed
     * @throws ClientException
     */
    public function __get($name)
    {
        if(!array_key_exists(strtolower($name), static::API_RESOURCES)) {
            throw new ClientException(sprintf('API Resource not exists: %s', $name));
        }

        if(!$this->skipUser) {
            $this->setResourceName($name);
        }

        $class = static::API_RESOURCES[$name];

        return new $class($this);
    }

}