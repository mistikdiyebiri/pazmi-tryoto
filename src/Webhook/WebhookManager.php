<?php

namespace Pazmi\TryOto\Webhook;

use Pazmi\TryOto\Common\ApiClient;

/**
 * Webhook İşlemleri Yöneticisi
 */
class WebhookManager
{
    /**
     * API istemcisi
     *
     * @var ApiClient
     */
    private $apiClient;
    
    /**
     * Yapılandırma
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }
    
    /**
     * Webhook oluşturur
     * 
     * @param array $webhookData Webhook verileri
     * @return array|null
     */
    public function createWebhook(array $webhookData): ?array
    {
        return $this->apiClient->post('webhooks', $webhookData);
    }
    
    /**
     * Webhookleri listeler
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getWebhooks(array $params = []): ?array
    {
        return $this->apiClient->get('webhooks', $params);
    }
    
    /**
     * Webhook günceller
     * 
     * @param string $webhookId Webhook ID
     * @param array $webhookData Webhook verileri
     * @return array|null
     */
    public function updateWebhook(string $webhookId, array $webhookData): ?array
    {
        return $this->apiClient->put('webhooks/' . $webhookId, $webhookData);
    }
    
    /**
     * Webhook siler
     * 
     * @param string $webhookId Webhook ID
     * @return array|null
     */
    public function deleteWebhook(string $webhookId): ?array
    {
        return $this->apiClient->delete('webhooks/' . $webhookId);
    }
    
    /**
     * Webhook olay tiplerini listeler
     * 
     * @return array|null
     */
    public function getEventTypes(): ?array
    {
        return $this->apiClient->get('webhooks/event-types');
    }
    
    /**
     * Webhook geçmişini getirir
     * 
     * @param string $webhookId Webhook ID
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getWebhookHistory(string $webhookId, array $params = []): ?array
    {
        return $this->apiClient->get('webhooks/' . $webhookId . '/history', $params);
    }
}