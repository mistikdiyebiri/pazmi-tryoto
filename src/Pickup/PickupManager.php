<?php

namespace Pazmi\TryOto\Pickup;

use Pazmi\TryOto\Common\ApiClient;

/**
 * Toplama Noktası İşlemleri Yöneticisi
 */
class PickupManager
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
     * Toplama noktası oluşturur
     * 
     * @param array $locationData Lokasyon verileri
     * @return array|null
     */
    public function createPickupLocation(array $locationData): ?array
    {
        return $this->apiClient->post('pickup-locations', $locationData);
    }
    
    /**
     * Toplama noktasını günceller
     * 
     * @param string $locationId Lokasyon ID
     * @param array $locationData Lokasyon verileri
     * @return array|null
     */
    public function updatePickupLocation(string $locationId, array $locationData): ?array
    {
        return $this->apiClient->post('pickup-locations/' . $locationId, $locationData);
    }
    
    /**
     * Toplama noktalarını listeler
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getPickupLocations(array $params = []): ?array
    {
        return $this->apiClient->get('pickup-locations', $params);
    }
    
    /**
     * Toplama noktası detaylarını getirir
     * 
     * @param string $locationId Lokasyon ID
     * @return array|null
     */
    public function getPickupLocationDetails(string $locationId): ?array
    {
        return $this->apiClient->get('pickup-locations/' . $locationId);
    }
    
    /**
     * Toplama noktasını siler
     * 
     * @param string $locationId Lokasyon ID
     * @return array|null
     */
    public function deletePickupLocation(string $locationId): ?array
    {
        return $this->apiClient->delete('pickup-locations/' . $locationId);
    }
    
    /**
     * Toplama talebinde bulunur
     * 
     * @param array $requestData Talep verileri
     * @return array|null
     */
    public function requestPickup(array $requestData): ?array
    {
        return $this->apiClient->post('pickup-requests', $requestData);
    }
    
    /**
     * Toplama taleplerini listeler
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getPickupRequests(array $params = []): ?array
    {
        return $this->apiClient->get('pickup-requests', $params);
    }
}