<?php

namespace Pazmi\TryOto\Account;

use Pazmi\TryOto\Common\ApiClient;

/**
 * Hesap İşlemleri Yöneticisi
 */
class AccountManager
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
     * Hesap kaydı yapar
     */
    public function register(array $userData): ?array
    {
        return $this->apiClient->post('account/register', $userData);
    }
    
    /**
     * Müşteri bilgilerini getirir
     */
    public function getClientInfo(): ?array
    {
        return $this->apiClient->get('account/client-info');
    }
    
    /**
     * Müşteri bilgilerini günceller
     */
    public function updateClientInfo(array $clientData): ?array
    {
        return $this->apiClient->post('account/client-info', $clientData);
    }
    
    /**
     * OTO kredi satın alır
     */
    public function buyOtoCredit(array $creditData): ?array
    {
        return $this->apiClient->post('account/buy-oto-credit', $creditData);
    }
    
    /**
     * Kargo kredisi satın alır
     */
    public function buyShippingCredit(array $creditData): ?array
    {
        return $this->apiClient->post('account/buy-shipping-credit', $creditData);
    }
    
    /**
     * Kredi işlemlerini listeler
     */
    public function getCreditTransactions(array $params = []): ?array
    {
        return $this->apiClient->get('account/credit-transactions', $params);
    }
}