<?php

namespace Pazmi\TryOto\Tracking;

use Pazmi\TryOto\Common\ApiClient;

/**
 * Takip İşlemleri Yöneticisi
 */
class TrackingManager
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
     * Sipariş takibi yapar
     * 
     * @param string $orderId Sipariş ID
     * @return array|null
     */
    public function trackOrder(string $orderId): ?array
    {
        return $this->apiClient->post('tracking/order', [
            'order_id' => $orderId
        ]);
    }
    
    /**
     * Sipariş geçmişini getirir
     * 
     * @param string $orderId Sipariş ID
     * @return array|null
     */
    public function getOrderHistory(string $orderId): ?array
    {
        return $this->apiClient->post('tracking/order-history', [
            'order_id' => $orderId
        ]);
    }
    
    /**
     * Gönderi takibi yapar
     * 
     * @param string $trackingNumber Takip numarası
     * @return array|null
     */
    public function trackShipment(string $trackingNumber): ?array
    {
        return $this->apiClient->post('tracking/shipment', [
            'tracking_number' => $trackingNumber
        ]);
    }
    
    /**
     * Çoklu gönderi takibi yapar
     * 
     * @param array $trackingNumbers Takip numaraları
     * @return array|null
     */
    public function trackMultipleShipments(array $trackingNumbers): ?array
    {
        return $this->apiClient->post('tracking/shipments', [
            'tracking_numbers' => $trackingNumbers
        ]);
    }
    
    /**
     * Tarih aralığına göre gönderi takibi yapar
     * 
     * @param string $startDate Başlangıç tarihi (Y-m-d)
     * @param string $endDate Bitiş tarihi (Y-m-d)
     * @return array|null
     */
    public function trackShipmentsByDateRange(string $startDate, string $endDate): ?array
    {
        return $this->apiClient->post('tracking/shipments-by-date', [
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);
    }
}