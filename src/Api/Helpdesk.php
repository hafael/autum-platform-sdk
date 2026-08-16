<?php

namespace Autum\SDK\Platform\Api;

use Hafael\HttpClient\Api\Api;
use Hafael\HttpClient\Route;

class Helpdesk extends Api
{
    /**
     * List tickets paginated
     * 
     * @param array $params
     * @return mixed
     */
    public function listTickets($params = [])
    {
        return $this->client->get(new Route(['tickets']), $params);
    }

    /**
     * Show ticket by ID
     * 
     * @param string $ticketId
     * @return mixed
     */
    public function showTicket($ticketId)
    {
        return $this->client->get(new Route(['tickets/', $ticketId]));
    }

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

    /**
     * Update ticket
     * 
     * @param string $ticketId
     * @param array $data
     * @return mixed
     */
    public function updateTicket($ticketId, $data)
    {
        return $this->client->put(new Route(['tickets/', $ticketId]), $this->getBody($data));
    }

    /**
     * Add comment to ticket
     * 
     * @param string $ticketId
     * @param array $data [message, is_private, notify_customer]
     * @return mixed
     */
    public function addComment($ticketId, $data)
    {
        return $this->client->post(new Route(['tickets/', $ticketId, '/comments']), $this->getBody($data));
    }

    /**
     * Get ticket comments
     * 
     * @param string $ticketId
     * @return mixed
     */
    public function getComments($ticketId)
    {
        return $this->client->get(new Route(['tickets/', $ticketId, '/comments']));
    }

    /**
     * Rate ticket satisfaction
     * 
     * @param string $ticketId
     * @param array $data [satisfaction_rating, feedback]
     * @return mixed
     */
    public function rateTicket($ticketId, $data)
    {
        return $this->client->post(new Route(['tickets/', $ticketId, '/rate']), $this->getBody($data));
    }
}