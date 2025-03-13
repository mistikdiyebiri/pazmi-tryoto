<?php

namespace Pazmi\TryOto\Carrier;

use Pazmi\TryOto\Common\ApiClient;

/**
 * Taşıyıcı Entegrasyon İşlemleri Yöneticisi
 */
class CarrierManager
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
     * OTO teslimat ücretini kontrol eder
     * 
     * @param array $checkData Kontrol verileri
     * @return array|null
     */
    public function checkOtoDeliveryFee(array $checkData): ?array
    {
        return $this->apiClient->post('carriers/check-oto-delivery-fee', $checkData);
    }
    
    /**
     * Teslimat ücretini kontrol eder
     * 
     * @param array $checkData Kontrol verileri
     * @return array|null
     */
    public function checkDeliveryFee(array $checkData): ?array
    {
        return $this->apiClient->post('carriers/check-delivery-fee', $checkData);
    }
    
    /**
     * Teslimat ücretini getirir
     * 
     * @param array $feeData Ücret verileri
     * @return array|null
     */
    public function getDeliveryFee(array $feeData): ?array
    {
        return $this->apiClient->post('carriers/get-delivery-fee', $feeData);
    }
    
    /**
     * Teslimat tahmini getirir
     * 
     * @param array $estimationData Tahmin verileri
     * @return array|null
     */
    public function getDeliveryEstimation(array $estimationData): ?array
    {
        return $this->apiClient->post('carriers/get-delivery-estimation', $estimationData);
    }
    
    /**
     * Kapsama alanını kontrol eder
     * 
     * @param array $coverageData Kapsama verileri
     * @return array|null
     */
    public function checkCoverage(array $coverageData): ?array
    {
        return $this->apiClient->post('carriers/check-coverage', $coverageData);
    }
    
    /**
     * Mevcut şehirleri getirir
     * 
     * @return array|null
     */
    public function getAvailableCities(): ?array
    {
        return $this->apiClient->post('carriers/available-cities', []);
    }
    
    /**
     * Mevcut zaman dilimlerini getirir
     * 
     * @param array $slotData Zaman dilimi verileri
     * @return array|null
     */
    public function getAvailableTimeSlots(array $slotData): ?array
    {
        return $this->apiClient->post('carriers/available-time-slots', $slotData);
    }
    
    /**
     * Dağıtım merkezi listesini getirir
     * 
     * @return array|null
     */
    public function getDCList(): ?array
    {
        return $this->apiClient->post('carriers/dc-list', []);
    }
    
    /**
     * Dağıtım merkezi yapılandırmasını getirir
     * 
     * @param string $dcId Dağıtım merkezi ID
     * @return array|null
     */
    public function getDCConfig(string $dcId): ?array
    {
        return $this->apiClient->post('carriers/dc-config', ['dc_id' => $dcId]);
    }
    
    /**
     * Dağıtım merkezi aktivasyonunu yapar
     * 
     * @param string $dcId Dağıtım merkezi ID
     * @param array $activationData Aktivasyon verileri
     * @return array|null
     */
    public function activateDC(string $dcId, array $activationData = []): ?array
    {
        $data = array_merge(['dc_id' => $dcId], $activationData);
        return $this->apiClient->post('carriers/dc-activation', $data);
    }
    
    /**
     * Teslimat seçeneklerini getirir
     * 
     * @param array $optionData Seçenek verileri
     * @return array|null
     */
    public function getDeliveryOptions(array $optionData = []): ?array
    {
        return $this->apiClient->get('carriers/delivery-options', $optionData);
    }
    
    /**
     * Şehirleri getirir
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getCities(array $params = []): ?array
    {
        return $this->apiClient->post('carriers/get-cities', $params);
    }
    
    /**
     * Taşıyıcıları listeler
     * 
     * @return array|null
     */
    public function getCarriers(): ?array
    {
        return $this->apiClient->get('carriers');
    }
    
    /**
     * Taşıyıcı servisleri listeler
     * 
     * @param string $carrierId Taşıyıcı ID
     * @return array|null
     */
    public function getCarrierServices(string $carrierId): ?array
    {
        return $this->apiClient->get('carriers/' . $carrierId . '/services');
    }
}