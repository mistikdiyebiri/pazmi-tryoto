<?php

namespace Pazmi\TryOto\ReturnShipment;

use Pazmi\TryOto\Common\ApiClient;

/**
 * İade Gönderileri İşlemleri Yöneticisi
 */
class ReturnShipmentManager
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
     * İade gönderi oluşturur
     * 
     * @param array $returnData İade verileri
     * @return array|null
     */
    public function createReturnShipment(array $returnData): ?array
    {
        return $this->apiClient->post('returns/create', $returnData);
    }
    
    /**
     * İade linki getirir
     * 
     * @param array $linkData Link verileri
     * @return array|null
     */
    public function getReturnLink(array $linkData): ?array
    {
        return $this->apiClient->post('returns/link', $linkData);
    }
    
    /**
     * İade detaylarını getirir
     * 
     * @param string $returnId İade ID
     * @return array|null
     */
    public function getReturnDetails(string $returnId): ?array
    {
        return $this->apiClient->post('returns/details', [
            'return_id' => $returnId
        ]);
    }
    
    /**
     * İade SMS'i tetikler
     * 
     * @param array $smsData SMS verileri
     * @return array|null
     */
    public function triggerReturnSMS(array $smsData): ?array
    {
        return $this->apiClient->post('returns/trigger-sms', $smsData);
    }
    
    /**
     * İade işlemlerini listeler
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getReturnShipments(array $params = []): ?array
    {
        return $this->apiClient->get('returns', $params);
    }
    
    /**
     * İade durumunu günceller
     * 
     * @param string $returnId İade ID
     * @param string $status Yeni durum
     * @return array|null
     */
    public function updateReturnStatus(string $returnId, string $status): ?array
    {
        return $this->apiClient->post('returns/update-status', [
            'return_id' => $returnId,
            'status' => $status
        ]);
    }
}