<?php

namespace Autum\SDK\Platform\Api;

use Hafael\HttpClient\Api\Api;
use Hafael\HttpClient\Route;

class SocialMonitor extends Api
{
    /**
     * Get monitored terms list
     * 
     * @param array $params
     * @return mixed
     */
    public function getMonitoredTerms($params = [])
    {
        return $this->client->get(new Route(['monitoring/profiles']), $params);
    }

    /**
     * Get monitored posts insights
     * 
     * @param string $profileId
     * @return mixed
     */
    public function getProfileInsights($profileId)
    {
        return $this->client->get(new Route(['monitoring/profiles/', $profileId, '/insights']));
    }

    /**
     * Schedule a social post
     * 
     * @param array $data
     * @return mixed
     */
    public function schedulePost($data)
    {
        return $this->client->post(new Route(['posts']), $this->getBody($data));
    }

    /**
     * Create critical alert / SAC ticket trigger
     * 
     * @param array $data [term, sentiment, post_url, comment]
     * @return mixed
     */
    public function reportCrisisMention($data)
    {
        return $this->client->post(new Route(['monitoring/crisis-alert']), $this->getBody($data));
    }
}
