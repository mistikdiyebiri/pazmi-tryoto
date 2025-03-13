<?php

namespace Pazmi\TryOto\OtoFlex;

use Pazmi\TryOto\Common\ApiClient;

/**
 * OTO FLEX İşlemleri Yöneticisi
 */
class OtoFlexManager
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
     * Sürücü atar
     * 
     * @param array $assignData Atama verileri
     * @return array|null
     */
    public function assignDriver(array $assignData): ?array
    {
        return $this->apiClient->post('oto-flex/assign-driver', $assignData);
    }
    
    /**
     * OTO FLEX durumlarını listeler
     * 
     * @return array|null
     */
    public function getFlexStatuses(): ?array
    {
        return $this->apiClient->get('oto-flex/statuses');
    }
    
    /**
     * OTO FLEX sürücülerini listeler
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getDrivers(array $params = []): ?array
    {
        return $this->apiClient->get('oto-flex/drivers', $params);
    }
    
    /**
     * OTO FLEX teslim raporunu getirir
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getDeliveryReport(array $params = []): ?array
    {
        return $this->apiClient->get('oto-flex/delivery-report', $params);
    }
}