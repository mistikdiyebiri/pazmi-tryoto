<?php

namespace Config;

use Pazmi\TryOto\Config\TryOto as BaseTryOto;

class TryOto extends BaseTryOto
{
    /**
     * API Anahtarı
     * 
     * @var string
     */
    public $apiKey = 'YOUR_API_KEY';
    
    /**
     * API Şifresi
     * 
     * @var string
     */
    public $apiSecret = 'YOUR_API_SECRET';
    
    /**
     * Ortam (production veya staging)
     * 
     * @var string
     */
    public $environment = 'staging'; // veya 'production'
}