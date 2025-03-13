<?php

namespace Pazmi\TryOto\OtoFlex;

use Pazmi\TryOto\Common\ApiClient;

/**
 * OTO FLEX Sürücü İşlemleri Yöneticisi
 */
class DriverManager
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
     * Sürücü oluşturur
     * 
     * @param array $driverData Sürücü verileri
     * @return array|null
     */
    public function createDriver(array $driverData): ?array
    {
        return $this->apiClient->post('oto-flex/drivers', $driverData);
    }
    
    /**
     * Sürücüyü günceller
     * 
     * @param string $driverId Sürücü ID
     * @param array $driverData Sürücü verileri
     * @return array|null
     */
    public function updateDriver(string $driverId, array $driverData): ?array
    {
        return $this->apiClient->put('oto-flex/drivers/' . $driverId, $driverData);
    }
    
    /**
     * Sürücüyü siler
     * 
     * @param string $driverId Sürücü ID
     * @return array|null
     */
    public function deleteDriver(string $driverId): ?array
    {
        return $this->apiClient->delete('oto-flex/drivers/' . $driverId);
    }
    
    /**
     * Sürücüleri listeler
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getDrivers(array $params = []): ?array
    {
        return $this->apiClient->get('oto-flex/drivers', $params);
    }
    
    /**
     * Sürücü detaylarını getirir
     * 
     * @param string $driverId Sürücü ID
     * @return array|null
     */
    public function getDriverDetails(string $driverId): ?array
    {
        return $this->apiClient->get('oto-flex/drivers/' . $driverId);
    }
    
    /**
     * Sürücü durumunu günceller
     * 
     * @param string $driverId Sürücü ID
     * @param string $status Yeni durum
     * @return array|null
     */
    public function updateDriverStatus(string $driverId, string $status): ?array
    {
        return $this->apiClient->put('oto-flex/drivers/' . $driverId . '/status', [
            'status' => $status
        ]);
    }
    
    /**
     * Sürücüye gönderi atar
     * 
     * @param string $driverId Sürücü ID
     * @param array $shipmentIds Gönderi ID'leri
     * @return array|null
     */
    public function assignShipments(string $driverId, array $shipmentIds): ?array
    {
        return $this->apiClient->post('oto-flex/drivers/' . $driverId . '/assign', [
            'shipment_ids' => $shipmentIds
        ]);
    }
}