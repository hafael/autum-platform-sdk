<?php

namespace Autum\SDK\Platform\Api;

use Hafael\HttpClient\Api\Api;
use Hafael\HttpClient\Route;

class Teams extends Api
{

    /**
     * Get Team list
     * 
     * @param string|null $query
     * @return mixed
     */
    public function getList($query = null)
    {
        return $this->client->get(new Route(['teams']), [
            'query' => $query,
        ]);
    }

    /**
     * Create new Team
     * 
     * @param array $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->client->post(new Route(['teams']), $this->getBody($data));
    }

    /**
     * Show Team by Id.
     *
     * @param string $teamId
     * @return mixed
     */
    public function showById($teamId)
    {
        return $this->client->get(new Route(['teams/', $teamId]));
    }

    /**
     * Update Team by Id.
     *
     * @param string $teamId
     * @param array $data
     * @return mixed
     */
    public function update($teamId, $data)
    {
        return $this->client->put(new Route(['teams/', $teamId]), $this->getBody($data));
    }

    /**
     * Delete Team by Id.
     *
     * @param string $teamId
     * @return mixed
     */
    public function delete($teamId)
    {
        return $this->client->delete(new Route(['teams/', $teamId]));
    }

    /**
     * Show Current Team by User.
     *
     * @return mixed
     */
    public function getCurrentTeam()
    {
        return $this->client->get(new Route(['account/current-team']));
    }

    /**
     * Show Current Team by User.
     *
     * @return mixed
     */
    public function switchCurrentTeam($teamId)
    {
        return $this->client->put(new Route(['account/current-team']), [
            'team_id' => $teamId,
        ]);
    }

    /**
     * Show Team by Id.
     *
     * @param string $teamId
     * @param string|null $query
     * @return mixed
     */
    public function getMembersList($teamId, $query = null)
    {
        return $this->client->get(new Route(['teams/', $teamId, '/members']), [
            'query' => $query,
        ]);
    }

    /**
     * Add Member by email to Team
     * 
     * @param string $teamId
     * @param string $email
     * @param string $role
     * @return mixed
     */
    public function addMember($teamId, $email, $role)
    {
        return $this->client->post(new Route(['teams/', $teamId]), $this->getBody([
            'email' => $email,
            'role'  => $role,
        ]));
    }

    /**
     * Change Team Member Role by User Id
     * 
     * @param string $teamId
     * @param string $userId
     * @param string $role
     * @return mixed
     */
    public function updateMember($teamId, $userId, $role)
    {
        return $this->client->put(new Route(['teams/', $teamId, '/members/', $userId]), $this->getBody([
            'role'  => $role,
        ]));
    }

    /**
     * Delete Team Member by Id.
     *
     * @param string $teamId
     * @param string $userId
     * @return mixed
     */
    public function deleteMember($teamId, $userId)
    {
        return $this->client->delete(new Route(['teams/', $teamId, '/members/', $userId]));
    }

}