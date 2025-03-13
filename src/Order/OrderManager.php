<?php

namespace Pazmi\TryOto\Order;

use Pazmi\TryOto\Common\ApiClient;

/**
 * Sipariş İşlemleri Yöneticisi
 */
class OrderManager
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
     * Sipariş oluşturur
     * 
     * @param array $orderData Sipariş verileri
     * @return array|null
     */
    public function createOrder(array $orderData): ?array
    {
        return $this->apiClient->post('orders', $orderData);
    }
    
    /**
     * Siparişi günceller
     * 
     * @param array $orderData Sipariş verileri
     * @return array|null
     */
    public function updateOrder(array $orderData): ?array
    {
        return $this->apiClient->post('orders/update', $orderData);
    }
    
    /**
     * Sipariş durumunu günceller
     * 
     * @param array $statusData Durum verileri
     * @return array|null
     */
    public function updateOrderStatus(array $statusData): ?array
    {
        return $this->apiClient->post('orders/update-status', $statusData);
    }
    
    /**
     * Siparişi iptal eder
     * 
     * @param string $orderId Sipariş ID
     * @return array|null
     */
    public function cancelOrder(string $orderId): ?array
    {
        return $this->apiClient->post('orders/cancel', [
            'order_id' => $orderId
        ]);
    }
    
    /**
     * Siparişleri listeler
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getOrders(array $params = []): ?array
    {
        return $this->apiClient->get('orders', $params);
    }
    
    /**
     * Sipariş detaylarını getirir
     * 
     * @param string $orderId Sipariş ID
     * @return array|null
     */
    public function getOrderDetails(string $orderId): ?array
    {
        return $this->apiClient->get('orders/' . $orderId);
    }
    
    /**
     * Siparişi bekletmeye alır
     * 
     * @param string $orderId Sipariş ID
     * @param array $holdData Bekletme verileri
     * @return array|null
     */
    public function holdOrder(string $orderId, array $holdData = []): ?array
    {
        $data = array_merge(['order_id' => $orderId], $holdData);
        return $this->apiClient->post('orders/hold', $data);
    }
    
    /**
     * Siparişi bekletmeden çıkarır
     * 
     * @param string $orderId Sipariş ID
     * @return array|null
     */
    public function unholdOrder(string $orderId): ?array
    {
        return $this->apiClient->post('orders/unhold', [
            'order_id' => $orderId
        ]);
    }
    
    /**
     * Sipariş durumlarını listeler
     * 
     * @return array|null
     */
    public function getOrderStatuses(): ?array
    {
        return $this->apiClient->get('orders/statuses');
    }
    
    /**
     * Sipariş iş akışlarını listeler
     * 
     * @return array|null
     */
    public function getOrderFlows(): ?array
    {
        return $this->apiClient->get('orders/flows');
    }
}