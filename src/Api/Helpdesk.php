<?php

namespace Autum\SDK\Platform\Api;

use Hafael\HttpClient\Api\Api;
use Hafael\HttpClient\Exceptions\ClientException;
use Hafael\HttpClient\Route;

class Helpdesk extends Api
{


    /**
     * Create new Ticket
     * 
     * @param array $data
     * @return mixed
     */
    public function createTicket($data)
    {
        return $this->client->post(new Route(['tickets']), $this->getBody($data));
    }

}