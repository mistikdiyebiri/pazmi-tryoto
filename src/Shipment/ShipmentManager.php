<?php

namespace Pazmi\TryOto\Shipment;

use Pazmi\TryOto\Common\ApiClient;
use Exception;

/**
 * Kargo İşlemleri Yöneticisi
 */
class ShipmentManager
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
     * Kargo gönderi oluşturur
     * 
     * @param array $shipmentData Gönderi verileri
     * @return array|null
     */
    public function createShipment(array $shipmentData): ?array
    {
        return $this->apiClient->post('shipments', $shipmentData);
    }
    
    /**
     * Gönderiyi iptal eder
     * 
     * @param string $shipmentId Gönderi ID
     * @return array|null
     */
    public function cancelShipment(string $shipmentId): ?array
    {
        return $this->apiClient->post('shipments/cancel', [
            'shipment_id' => $shipmentId
        ]);
    }
    
    /**
     * Gönderi işlemlerini listeler
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getShipmentTransactions(array $params = []): ?array
    {
        return $this->apiClient->get('shipments/transactions', $params);
    }
    
    /**
     * Kargo ücret işlemlerini listeler
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getShippingPriceTransactions(array $params = []): ?array
    {
        return $this->apiClient->post('shipments/price-transactions', $params);
    }
    
    /**
     * Gönderileri listeler
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getShipments(array $params = []): ?array
    {
        return $this->apiClient->get('shipments', $params);
    }
    
    /**
     * Gönderi detaylarını getirir
     * 
     * @param string $shipmentId Gönderi ID
     * @return array|null
     */
    public function getShipment(string $shipmentId): ?array
    {
        return $this->apiClient->get('shipments/' . $shipmentId);
    }
    
    /**
     * Teslimat durumunu günceller
     * 
     * @param string $shipmentId Gönderi ID
     * @param string $status Yeni durum
     * @param array $additionalData Ek veriler
     * @return array|null
     */
    public function updateDeliveryStatus(string $shipmentId, string $status, array $additionalData = []): ?array
    {
        $data = array_merge([
            'shipment_id' => $shipmentId,
            'status' => $status
        ], $additionalData);
        
        return $this->apiClient->post('shipments/update-status', $data);
    }
}