<?php

namespace Autum\SDK\Platform\Api;

use Hafael\HttpClient\Api\Api;
use Hafael\HttpClient\Route;

class Chatbot extends Api
{
    /**
     * Get bots list
     * 
     * @param array $params
     * @return mixed
     */
    public function listBots($params = [])
    {
        return $this->client->get(new Route(['bots']), $params);
    }

    /**
     * Show Bot by ID
     * 
     * @param string $botId
     * @return mixed
     */
    public function showBot($botId)
    {
        return $this->client->get(new Route(['bots/', $botId]));
    }

    /**
     * Send WhatsApp Message
     * 
     * @param array $data [phone, message, bot_id, metadata]
     * @return mixed
     */
    public function sendMessage($data)
    {
        return $this->client->post(new Route(['messages']), $this->getBody($data));
    }

    /**
     * List messages for a contact/phone
     * 
     * @param string $contactId
     * @param array $params
     * @return mixed
     */
    public function getMessages($contactId, $params = [])
    {
        return $this->client->get(new Route(['contacts/', $contactId, '/messages']), $params);
    }

    /**
     * Trigger handover from Bot to Human agent
     * 
     * @param string $contactId
     * @param array $data [reason, ticket_id]
     * @return mixed
     */
    public function triggerHandover($contactId, $data = [])
    {
        return $this->client->post(new Route(['contacts/', $contactId, '/handover']), $this->getBody($data));
    }

    /**
     * Ingest document to knowledge base RAG
     * 
     * @param string $knowledgeBaseId
     * @param array $data
     * @return mixed
     */
    public function ingestKnowledgeBaseDocument($knowledgeBaseId, $data)
    {
        return $this->client->post(new Route(['knowledge-bases/', $knowledgeBaseId, '/upload']), $this->getBody($data));
    }
}
