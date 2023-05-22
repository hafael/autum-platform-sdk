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
     * Get authenticated user organization info
     * 
     * @return mixed
     */
    public function getAccountOrganization()
    {
        return $this->client->get(new Route(['account/organization']));
    }

    /**
     * Get authenticated user current team info
     * 
     * @return mixed
     */
    public function getCurrentTeam()
    {
        return $this->client->get(new Route(['account/current-team']));
    }

    /**
     * Get authenticated user current team info
     * 
     * @return mixed
     */
    public function getCurrentTeamMembers()
    {
        return $this->client->get(new Route(['account/current-team/members']));
    }

    /**
     * Show Current Team by User.
     *
     * @param string $teamId
     * @return mixed
     */
    public function switchCurrentTeam($teamId)
    {
        return $this->client->put(new Route(['account/current-team']), [
            'team_id' => $teamId,
        ]);
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
        return $this->client->post(new Route(['auth/token']), $this->getBody([
            'name' => $name,
            'abilities' => $abilities
        ]));
    }

}