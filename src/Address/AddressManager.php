<?php

namespace Pazmi\TryOto\Address;

use Pazmi\TryOto\Common\ApiClient;

/**
 * Adres İşlemleri Yöneticisi
 */
class AddressManager
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
     * Teslimat noktalarını listeler
     */
    public function listDeliveryPoints(array $params = []): ?array
    {
        return $this->apiClient->get('delivery-points', $params);
    }
    
    /**
     * Adres doğrulama yapar
     */
    public function validateAddress(array $addressData): ?array
    {
        return $this->apiClient->post('address/validate', $addressData);
    }
}