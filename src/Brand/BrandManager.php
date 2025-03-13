<?php

namespace Pazmi\TryOto\Brand;

use Pazmi\TryOto\Common\ApiClient;

/**
 * Marka İşlemleri Yöneticisi
 */
class BrandManager
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
     * Müşteri mağazasındaki markaları listeler
     * 
     * @return array|null
     */
    public function getBrands(): ?array
    {
        return $this->apiClient->get('brands');
    }
    
    /**
     * Müşteri mağazasında marka oluşturur
     * 
     * @param array $brandData Marka verileri
     * @return array|null
     */
    public function createBrand(array $brandData): ?array
    {
        return $this->apiClient->post('brands', $brandData);
    }
    
    /**
     * Markayı günceller
     * 
     * @param string $brandId Marka ID
     * @param array $brandData Marka verileri
     * @return array|null
     */
    public function updateBrand(string $brandId, array $brandData): ?array
    {
        return $this->apiClient->put('brands/' . $brandId, $brandData);
    }
    
    /**
     * Markayı siler
     * 
     * @param string $brandId Marka ID
     * @return array|null
     */
    public function deleteBrand(string $brandId): ?array
    {
        return $this->apiClient->delete('brands/' . $brandId);
    }
}