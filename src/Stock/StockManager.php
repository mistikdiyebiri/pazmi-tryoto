<?php

namespace Pazmi\TryOto\Stock;

use Pazmi\TryOto\Common\ApiClient;

/**
 * Stok Yönetimi İşlemleri Yöneticisi
 */
class StockManager
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
     * Stok miktarını günceller
     * 
     * @param array $stockData Stok verileri
     * @return array|null
     */
    public function updateStockQuantity(array $stockData): ?array
    {
        return $this->apiClient->post('stock/update-quantity', $stockData);
    }
    
    /**
     * Envanter stokunu kontrol eder
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function checkInventoryStock(array $params = []): ?array
    {
        return $this->apiClient->get('stock/inventory', $params);
    }
    
    /**
     * Genel stoku kontrol eder
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function checkGlobalStock(array $params = []): ?array
    {
        return $this->apiClient->get('stock/global', $params);
    }
    
    /**
     * Envanter siparişi oluşturur
     * 
     * @param array $orderData Sipariş verileri
     * @return array|null
     */
    public function createInventoryOrder(array $orderData): ?array
    {
        return $this->apiClient->post('stock/inventory-order', $orderData);
    }
    
    /**
     * Paketleme durumunu günceller
     * 
     * @param array $statusData Durum verileri
     * @return array|null
     */
    public function updatePackingStatus(array $statusData): ?array
    {
        return $this->apiClient->post('stock/packing-status', $statusData);
    }
    
    /**
     * Paketleme için hazır siparişleri getirir
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getOrdersReadyForPacking(array $params = []): ?array
    {
        return $this->apiClient->get('stock/ready-for-packing', $params);
    }
    
    /**
     * Stok hareketlerini listeler
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getStockMovements(array $params = []): ?array
    {
        return $this->apiClient->get('stock/movements', $params);
    }
    
    /**
     * Stok envanter raporunu alır
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getInventoryReport(array $params = []): ?array
    {
        return $this->apiClient->get('stock/inventory-report', $params);
    }
}