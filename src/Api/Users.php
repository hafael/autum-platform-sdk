<?php

namespace Autum\SDK\Platform\Api;

use Hafael\HttpClient\Api\Api;
use Hafael\HttpClient\Route;

class Users extends Api
{

    /**
     * Get authenticated user info
     * 
     * @return mixed
     */
    public function getAuthenticatedUser()
    {
        return $this->client->get(new Route(['account']));
    }

    /**
     * Update authenticated user
     * 
     * @param array $data
     * @return mixed
     */
    public function updateAuthenticatedUser($data)
    {
        return $this->client->put(new Route(['account']), $this->getBody($data));
    }

    /**
     * Check user authenticated PIN code
     * 
     * @param string|int $pinCode
     * @return mixed
     */
    public function checkPin($pinCode)
    {
        return $this->client->post(new Route(['account/check-pin']), $this->getBody([
            'pin' => $pinCode
        ]));
    }

    /**
     * Check user authenticated password
     * 
     * @param string|int $password
     * @return mixed
     */
    public function checkPassword($password)
    {
        return $this->client->post(new Route(['account/check-password']), $this->getBody([
            'password' => $password
        ]));
    }

    /**
     * Generate access token for user (admin).
     * 
     * @param string $id
     * @param string $name
     * @param array $abilities
     * @return mixed
     */
    public function issueToken(string $id, string $name, array $abilities = ['*'])
    {
        return $this->client->post(new Route(['admin/users/', $id, '/issue-token']), $this->getBody([
            'name' => $name,
            'abilities' => $abilities
        ]));
    }

    

}