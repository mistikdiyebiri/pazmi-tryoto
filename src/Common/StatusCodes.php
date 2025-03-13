<?php

namespace Pazmi\TryOto\Common;

/**
 * TryOto API Durum Kodları
 * 
 * TryOto API'sinin kullandığı durum kodlarını ve açıklamalarını içerir
 */
class StatusCodes
{
    /**
     * Sipariş durum kodları
     *
     * @var array
     */
    private static $orderStatuses = [
        'NEW' => 'Yeni',
        'PROCESSING' => 'İşleniyor',
        'PACKED' => 'Paketlendi',
        'READY_TO_SHIP' => 'Gönderime Hazır',
        'SHIPPED' => 'Gönderildi',
        'IN_TRANSIT' => 'Taşınıyor',
        'OUT_FOR_DELIVERY' => 'Dağıtımda',
        'DELIVERED' => 'Teslim Edildi',
        'CANCELED' => 'İptal Edildi',
        'RETURNED' => 'İade Edildi',
        'ON_HOLD' => 'Beklemede',
        'FAILED_DELIVERY' => 'Teslimat Başarısız',
    ];
    
    /**
     * Kargo durum kodları
     *
     * @var array
     */
    private static $shipmentStatuses = [
        'CREATED' => 'Oluşturuldu',
        'PICKED_UP' => 'Alındı',
        'IN_TRANSIT' => 'Taşınıyor',
        'OUT_FOR_DELIVERY' => 'Dağıtımda',
        'DELIVERED' => 'Teslim Edildi',
        'CANCELED' => 'İptal Edildi',
        'RETURNED' => 'İade Edildi',
        'FAILED_DELIVERY' => 'Teslimat Başarısız',
    ];
    
    /**
     * İade kargo durum kodları
     *
     * @var array
     */
    private static $returnStatuses = [
        'RETURN_REQUESTED' => 'İade Talebi',
        'RETURN_APPROVED' => 'İade Onaylandı',
        'RETURN_REJECTED' => 'İade Reddedildi',
        'RETURN_IN_TRANSIT' => 'İade Taşınıyor',
        'RETURN_RECEIVED' => 'İade Alındı',
        'RETURN_COMPLETED' => 'İade Tamamlandı',
    ];
    
    /**
     * Stok durum kodları
     *
     * @var array
     */
    private static $stockStatuses = [
        'IN_STOCK' => 'Stokta',
        'OUT_OF_STOCK' => 'Stok Dışı',
        'LOW_STOCK' => 'Düşük Stok',
    ];
    
    /**
     * Sipariş durum açıklamasını döndürür
     *
     * @param string $code Durum kodu
     * @return string Durum açıklaması
     */
    public static function getOrderStatus(string $code): string
    {
        return self::$orderStatuses[$code] ?? 'Bilinmeyen durum';
    }
    
    /**
     * Kargo durum açıklamasını döndürür
     *
     * @param string $code Durum kodu
     * @return string Durum açıklaması
     */
    public static function getShipmentStatus(string $code): string
    {
        return self::$shipmentStatuses[$code] ?? 'Bilinmeyen durum';
    }
    
    /**
     * İade durum açıklamasını döndürür
     *
     * @param string $code Durum kodu
     * @return string Durum açıklaması
     */
    public static function getReturnStatus(string $code): string
    {
        return self::$returnStatuses[$code] ?? 'Bilinmeyen durum';
    }
    
    /**
     * Stok durum açıklamasını döndürür
     *
     * @param string $code Durum kodu
     * @return string Durum açıklaması
     */
    public static function getStockStatus(string $code): string
    {
        return self::$stockStatuses[$code] ?? 'Bilinmeyen durum';
    }
    
    /**
     * Tüm sipariş durumlarını döndürür
     *
     * @return array
     */
    public static function getAllOrderStatuses(): array
    {
        return self::$orderStatuses;
    }
    
    /**
     * Tüm kargo durumlarını döndürür
     *
     * @return array
     */
    public static function getAllShipmentStatuses(): array
    {
        return self::$shipmentStatuses;
    }
    
    /**
     * Tüm iade durumlarını döndürür
     *
     * @return array
     */
    public static function getAllReturnStatuses(): array
    {
        return self::$returnStatuses;
    }
    
    /**
     * Tüm stok durumlarını döndürür
     *
     * @return array
     */
    public static function getAllStockStatuses(): array
    {
        return self::$stockStatuses;
    }
}