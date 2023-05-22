<?php

namespace Autum\SDK\Platform\Api;

use Hafael\HttpClient\Api\Api;
use Hafael\HttpClient\Route;

class People extends Api
{

    /**
     * Get Contact list paginated
     * 
     * @param string|null $query
     * @param int $page
     * @param int $perPage
     * @return mixed
     */
    public function getList($query = null, $page = 1, $perPage = 10)
    {
        return $this->client->get(new Route(['people']), [
            'q' => $query,
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Create new Contact
     * 
     * @param array $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->client->post(new Route(['people']), $this->getBody($data));
    }

    /**
     * Show Contact by Id.
     *
     * @param string $contactId
     * @return mixed
     */
    public function showById($contactId)
    {
        return $this->client->get(new Route(['people/', $contactId]));
    }

    /**
     * Update Contact by Id.
     *
     * @param string $contactId
     * @param array $data
     * @return mixed
     */
    public function update($contactId, $data)
    {
        return $this->client->put(new Route(['people/', $contactId]), $this->getBody($data));
    }

    /**
     * Delete Contact by Id.
     *
     * @param string $contactId
     * @return mixed
     */
    public function delete($contactId)
    {
        return $this->client->delete(new Route(['people/', $contactId]));
    }

}