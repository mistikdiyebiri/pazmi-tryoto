<?php

namespace Pazmi\TryOto\Common;

/**
 * TryOto API Hata Kodları
 * 
 * TryOto API'sinin döndürdüğü hata kodlarını ve açıklamalarını içerir
 */
class ErrorCodes
{
    /**
     * Hata kodları ve açıklamaları
     *
     * @var array
     */
    private static $errorCodes = [
        '400' => 'Geçersiz istek',
        '401' => 'Yetkilendirme hatası',
        '403' => 'Erişim reddedildi',
        '404' => 'Bulunamadı',
        '409' => 'Çakışma hatası',
        '422' => 'İşlenemedi',
        '429' => 'Çok fazla istek',
        '500' => 'Sunucu hatası',
        
        // Sipariş işlemleri hataları
        'ORDER_001' => 'Sipariş oluşturma hatası',
        'ORDER_002' => 'Sipariş bulunamadı',
        'ORDER_003' => 'Sipariş güncellenemiyor',
        'ORDER_004' => 'Sipariş iptal edilemiyor',
        
        // Kargo işlemleri hataları
        'SHIPMENT_001' => 'Kargo oluşturma hatası',
        'SHIPMENT_002' => 'Kargo bulunamadı',
        'SHIPMENT_003' => 'Kargo iptal edilemiyor',
        
        // Ödeme işlemleri hataları
        'PAYMENT_001' => 'Ödeme işleme hatası',
        'PAYMENT_002' => 'Yetersiz kredi',
        
        // Adres işlemleri hataları
        'ADDRESS_001' => 'Geçersiz adres',
        'ADDRESS_002' => 'Adres doğrulanamadı',
        'ADDRESS_003' => 'Bu bölgeye teslimat yapılamamaktadır',
        
        // Stok işlemleri hataları
        'STOCK_001' => 'Yetersiz stok',
        'STOCK_002' => 'Stok güncellenemedi',
        
        // Yetkilendirme hataları
        'AUTH_001' => 'Geçersiz kimlik bilgileri',
        'AUTH_002' => 'Süresi dolmuş token',
        'AUTH_003' => 'Geçersiz token',
    ];
    
    /**
     * Hata kodu açıklamasını döndürür
     *
     * @param string $code Hata kodu
     * @return string Hata açıklaması
     */
    public static function getMessage(string $code): string
    {
        return self::$errorCodes[$code] ?? 'Bilinmeyen hata';
    }
    
    /**
     * Tüm hata kodlarını ve açıklamalarını döndürür
     *
     * @return array
     */
    public static function getAll(): array
    {
        return self::$errorCodes;
    }
}