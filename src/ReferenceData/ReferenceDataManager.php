<?php

namespace Pazmi\TryOto\ReferenceData;

use Pazmi\TryOto\Common\ApiClient;

/**
 * Referans Veri İşlemleri Yöneticisi
 */
class ReferenceDataManager
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
     * Desteklenen servisleri listeler
     */
    public function listServices(): ?array
    {
        return $this->apiClient->get('services');
    }
    
    /**
     * Desteklenen ülkeleri listeler
     */
    public function listCountries(): ?array
    {
        return $this->apiClient->get('countries');
    }
    
    /**
     * İl listesini getirir
     */
    public function listProvinces(string $countryCode = 'TR'): ?array
    {
        return $this->apiClient->get('provinces', ['country_code' => $countryCode]);
    }
    
    /**
     * İlçe listesini getirir
     */
    public function listDistricts(string $provinceCode): ?array
    {
        return $this->apiClient->get('districts', ['province_code' => $provinceCode]);
    }
    
    /**
     * Mahalle/Semt listesini getirir
     */
    public function listNeighborhoods(string $districtCode): ?array
    {
        return $this->apiClient->get('neighborhoods', ['district_code' => $districtCode]);
    }
}