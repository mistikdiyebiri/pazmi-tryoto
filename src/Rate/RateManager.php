<?php

namespace Pazmi\TryOto\Rate;

use Pazmi\TryOto\Common\ApiClient;

/**
 * Ücret İşlemleri Yöneticisi
 */
class RateManager
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
     * Kargo ücretini hesaplar
     */
    public function calculateRate(array $rateData): ?array
    {
        return $this->apiClient->post('rates/calculate', $rateData);
    }
}