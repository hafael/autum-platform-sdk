<?php

namespace Autum\SDK\Platform\Api;

use Hafael\HttpClient\Api\Api;
use Hafael\HttpClient\Route;

class Applications extends Api
{

    /**
     * Get Application list paginated
     * 
     * @param string|null $query
     * @param int $page
     * @param int $perPage
     * @return mixed
     */
    public function getList($query = null, $page = 1, $perPage = 10)
    {
        return $this->client->get(new Route(['applications']), [
            'q' => $query,
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Show Application by Id.
     *
     * @param string $id
     * @return mixed
     */
    public function showById($id)
    {
        return $this->client->get(new Route(['applications/', $id]));
    }


}