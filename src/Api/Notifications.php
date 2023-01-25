<?php

namespace Autum\SDK\Platform\Api;

use Hafael\HttpClient\Api\Api;
use Hafael\HttpClient\Route;

class Notifications extends Api
{

    /**
     * Get user notifications paginated.
     * 
     * @param string|null $query
     * @param int $page
     * @param int $perPage
     * @return mixed
     */
    public function getList($query = null, $page = 1, $perPage = 10)
    {
        return $this->client->get(new Route(['notifications']), [
            'query' => $query,
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Show notification by Id.
     *
     * @param string $notificationId
     * @return mixed
     */
    public function showById($notificationId)
    {
        return $this->client->get(new Route(['notifications/mark-as-read']));
    }

    /**
     * Clear all notifications.
     *
     * @return mixed
     */
    public function clearAll($query = null, $page = 1, $perPage = 10)
    {
        return $this->client->delete(new Route(['notifications']));
    }

    /**
     * Clear all notifications.
     *
     * @return mixed
     */
    public function readAll()
    {
        return $this->client->put(new Route(['notifications/mark-as-read']), []);
    }

    /**
     * Mark notification as read.
     *
     * @param string $notificationId
     * @return mixed
     */
    public function markAsRead($notificationId)
    {
        return $this->client->get(new Route(['notifications', $notificationId]));
    }

}