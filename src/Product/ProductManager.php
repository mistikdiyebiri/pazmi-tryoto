<?php

namespace Pazmi\TryOto\Product;

use Pazmi\TryOto\Common\ApiClient;

/**
 * Ürün İşlemleri Yöneticisi
 */
class ProductManager
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
     * Ürün oluşturur
     * 
     * @param array $productData Ürün verileri
     * @return array|null
     */
    public function createProduct(array $productData): ?array
    {
        return $this->apiClient->post('products', $productData);
    }
    
    /**
     * Ürünleri listeler
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getProducts(array $params = []): ?array
    {
        return $this->apiClient->post('products/list', $params);
    }
    
    /**
     * Ürün günceller
     * 
     * @param string $productId Ürün ID
     * @param array $productData Ürün verileri
     * @return array|null
     */
    public function updateProduct(string $productId, array $productData): ?array
    {
        return $this->apiClient->put('products/' . $productId, $productData);
    }
    
    /**
     * Ürünü siler
     * 
     * @param string $productId Ürün ID
     * @return array|null
     */
    public function deleteProduct(string $productId): ?array
    {
        return $this->apiClient->delete('products/' . $productId);
    }
    
    /**
     * Kutu ekler
     * 
     * @param array $boxData Kutu verileri
     * @return array|null
     */
    public function addBox(array $boxData): ?array
    {
        return $this->apiClient->post('products/boxes', $boxData);
    }
    
    /**
     * Kutu günceller
     * 
     * @param string $boxId Kutu ID
     * @param array $boxData Kutu verileri
     * @return array|null
     */
    public function updateBox(string $boxId, array $boxData): ?array
    {
        return $this->apiClient->post('products/boxes/' . $boxId, $boxData);
    }
    
    /**
     * Kutu bilgisini getirir
     * 
     * @param string $boxId Kutu ID
     * @return array|null
     */
    public function getBox(string $boxId): ?array
    {
        return $this->apiClient->get('products/boxes/' . $boxId);
    }
    
    /**
     * Kutuları listeler
     * 
     * @param array $params Filtre parametreleri
     * @return array|null
     */
    public function getBoxes(array $params = []): ?array
    {
        return $this->apiClient->get('products/boxes', $params);
    }
    
    /**
     * Kutu siler
     * 
     * @param string $boxId Kutu ID
     * @return array|null
     */
    public function deleteBox(string $boxId): ?array
    {
        return $this->apiClient->delete('products/boxes/' . $boxId);
    }
}