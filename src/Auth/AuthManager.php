<?php

namespace Pazmi\TryOto\Auth;

use Pazmi\TryOto\Common\ApiClient;

/**
 * Yetkilendirme İşlemleri Yöneticisi
 */
class AuthManager
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
     * Yetkilendirme yapar
     * 
     * @param array $credentials Kullanıcı bilgileri
     * @return array|null
     */
    public function authorize(array $credentials): ?array
    {
        $result = $this->apiClient->post('auth', $credentials);
        
        if ($result && isset($result['access_token'])) {
            $this->apiClient->setAccessToken($result['access_token']);
        }
        
        return $result;
    }
    
    /**
     * Token yeniler
     * 
     * @param string $refreshToken Yenileme tokeni
     * @return array|null
     */
    public function refreshToken(string $refreshToken): ?array
    {
        $result = $this->apiClient->get('auth/refresh-token', [
            'refresh_token' => $refreshToken
        ]);
        
        if ($result && isset($result['access_token'])) {
            $this->apiClient->setAccessToken($result['access_token']);
        }
        
        return $result;
    }
    
    /**
     * Sağlık kontrolü yapar
     * 
     * @return array|null
     */
    public function healthCheck(): ?array
    {
        return $this->apiClient->get('health-check');
    }
}