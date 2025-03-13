# TryOto API - CodeIgniter 4 Kütüphanesi

Bu kütüphane, TryOto kargo firmasının API'sine CodeIgniter 4 üzerinden kolayca erişim sağlar.

## Özellikler

- Kolay entegrasyon
- CodeIgniter 4 uyumlu
- Production ve staging ortamı desteği
- Temel TryOto API fonksiyonlarına erişim

## Kurulum

```bash
composer require pazmi/tryoto
```

## Yapılandırma

`app/Config/TryOto.php` dosyasını oluşturun:

```php
<?php

namespace Config;

use Pazmi\TryOto\Config\TryOto as BaseTryOto;

class TryOto extends BaseTryOto
{
    public $apiKey = 'API_KEY';
    public $apiSecret = 'API_SECRET';
    public $environment = 'staging'; // veya 'production'
}
```

## Kullanım Örnekleri

### Kütüphaneyi Başlatma

```php
use Pazmi\TryOto\TryOto;
use Config\TryOto as TryOtoConfig;

$config = new TryOtoConfig();
$tryoto = new TryOto([
    'api_key' => $config->apiKey,
    'api_secret' => $config->apiSecret,
    'environment' => $config->environment,
]);
```

### Kargo Gönderi Oluşturma

```php
$shipmentData = [
    'sender' => [
        'name' => 'Gönderici Adı',
        'company_name' => 'Gönderici Firma Adı',
        'address' => 'Gönderici Adresi',
        'city' => 'İstanbul',
        'district' => 'Kadıköy',
        'phone' => '05551234567',
        'email' => 'gonderen@example.com'
    ],
    'recipient' => [
        'name' => 'Alıcı Adı',
        'company_name' => 'Alıcı Firma Adı',
        'address' => 'Alıcı Adresi',
        'city' => 'Ankara',
        'district' => 'Çankaya',
        'phone' => '05559876543',
        'email' => 'alici@example.com'
    ],
    'parcels' => [
        [
            'weight' => 1.5, // kg
            'width' => 30, // cm
            'height' => 20, // cm
            'length' => 15 // cm
        ]
    ],
    'service_code' => 'STANDARD',
    'reference' => 'Sipariş-123',
];

$result = $tryoto->createShipment($shipmentData);
```

### Gönderi Takibi

```php
$result = $tryoto->trackShipment('123456789');
```

### Hesap İşlemleri

```php
// Müşteri bilgilerini getir
$clientInfo = $tryoto->getClientInfo();

// Kredi işlemlerini listele
$transactions = $tryoto->getCreditTransactions([
    'start_date' => '2023-01-01',
    'end_date' => '2023-12-31'
]);

// OTO kredi satın al
$result = $tryoto->buyOtoCredit([
    'amount' => 100,
    'payment_method' => 'credit_card',
    'card_info' => [
        // Kart bilgileri
    ]
]);
```

Daha fazla örnek için lütfen dokümantasyona bakınız.

## Lisans

MIT