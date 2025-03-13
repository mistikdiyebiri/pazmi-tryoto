<?php

namespace Pazmi\TryOto\Config;

use CodeIgniter\Config\BaseConfig;

class TryOto extends BaseConfig
{
    /**
     * API Anahtarı
     * 
     * @var string
     */
    public $apiKey = '';
    
    /**
     * API Şifresi
     * 
     * @var string
     */
    public $apiSecret = '';
    
    /**
     * Ortam (production veya staging)
     * 
     * @var string
     */
    public $environment = 'production';
}