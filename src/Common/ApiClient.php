<?php

namespace Pazmi\TryOto\Common;

use CodeIgniter\HTTP\CURLRequest;
use CodeIgniter\HTTP\Response;
use Config\Services;
use Exception;

/**
 * TryOto API İstemcisi
 * 
 * TryOto API isteklerini yönetir
 */
class ApiClient
{
    /**
     * API Canlı Ortam URL'i
     * 
     * @var string
     */
    private $productionUrl = 'https://api.tryoto.com/rest/v2/';
    
    /**
     * API Test Ortamı URL'i
     * 
     * @var string
     */
    private $stagingUrl = 'https://staging-api.tryoto.com/rest/v2/';
    
    /**
     * API Anahtarı
     * 
     * @var string
     */
    private $apiKey;
    
    /**
     * API Şifresi
     * 
     * @var string
     */
    private $apiSecret;
    
    /**
     * Ortam (production veya staging)
     * 
     * @var string
     */
    private $environment;
    
    /**
     * HTTP Client
     *
     * @var CURLRequest
     */
    private $client;
    
    /**
     * Hata mesajı
     *
     * @var string
     */
    private $error;
    
    /**
     * Access Token
     *
     * @var string|null
     */
    private $accessToken = null;
    
    /**
     * Sınıf yapılandırması
     */
    public function __construct(array $config = [])
    {
        // Yapılandırma değerlerini ayarla
        $this->initialize($config);
        
        // HTTP istemcisini yapılandır
        $this->client = Services::curlrequest([
            'baseURI' => $this->getBaseUrl(),
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);
    }
    
    /**
     * Sınıfı yapılandırma
     */
    public function initialize(array $config = []): self
    {
        $this->apiKey = $config['api_key'] ?? getenv('TRYOTO_API_KEY') ?? '';
        $this->apiSecret = $config['api_secret'] ?? getenv('TRYOTO_API_SECRET') ?? '';
        $this->environment = $config['environment'] ?? getenv('TRYOTO_ENVIRONMENT') ?? 'production';
        $this->accessToken = $config['access_token'] ?? null;
        
        return $this;
    }
    
    /**
     * Kullanılacak temel URL'i belirler
     */
    private function getBaseUrl(): string
    {
        return ($this->environment === 'production') ? $this->productionUrl : $this->stagingUrl;
    }
    
    /**
     * API anahtarını ayarlar
     */
    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;
        return $this;
    }
    
    /**
     * API şifresini ayarlar
     */
    public function setApiSecret(string $apiSecret): self
    {
        $this->apiSecret = $apiSecret;
        return $this;
    }
    
    /**
     * Access Token'ı ayarlar
     */
    public function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;
        return $this;
    }
    
    /**
     * Ortamı ayarlar (production veya staging)
     */
    public function setEnvironment(string $environment): self
    {
        $this->environment = $environment;
        return $this;
    }
    
    /**
     * Son hatayı döndürür
     */
    public function getError(): string
    {
        return $this->error;
    }
    
    /**
     * API kimlik doğrulama bilgilerini döndürür
     */
    private function getAuthHeaders(): array
    {
        if ($this->accessToken) {
            return [
                'Authorization' => 'Bearer ' . $this->accessToken,
            ];
        }
        
        return [
            'Authorization' => 'Basic ' . base64_encode($this->apiKey . ':' . $this->apiSecret),
        ];
    }
    
    /**
     * API'ye GET isteği gönderir
     */
    public function get(string $endpoint, array $params = []): ?array
    {
        try {
            $options = [
                'headers' => $this->getAuthHeaders(),
                'query' => $params,
            ];
            
            $response = $this->client->get($endpoint, $options);
            
            return $this->handleResponse($response);
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return null;
        }
    }
    
    /**
     * API'ye POST isteği gönderir
     */
    public function post(string $endpoint, array $data = []): ?array
    {
        try {
            $options = [
                'headers' => $this->getAuthHeaders(),
                'json' => $data,
            ];
            
            $response = $this->client->post($endpoint, $options);
            
            return $this->handleResponse($response);
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return null;
        }
    }
    
    /**
     * API'ye PUT isteği gönderir
     */
    public function put(string $endpoint, array $data = []): ?array
    {
        try {
            $options = [
                'headers' => $this->getAuthHeaders(),
                'json' => $data,
            ];
            
            $response = $this->client->put($endpoint, $options);
            
            return $this->handleResponse($response);
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return null;
        }
    }
    
    /**
     * API'ye DELETE isteği gönderir
     */
    public function delete(string $endpoint, array $params = []): ?array
    {
        try {
            $options = [
                'headers' => $this->getAuthHeaders(),
                'query' => $params,
            ];
            
            $response = $this->client->delete($endpoint, $options);
            
            return $this->handleResponse($response);
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return null;
        }
    }
    
    /**
     * API'ye özel başlıklarla GET isteği gönderir
     */
    public function getWithHeaders(string $endpoint, array $params = [], array $headers = []): ?Response
    {
        try {
            $options = [
                'headers' => array_merge($this->getAuthHeaders(), $headers),
                'query' => $params,
            ];
            
            return $this->client->get($endpoint, $options);
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return null;
        }
    }
    
    /**
     * API'ye özel başlıklarla POST isteği gönderir
     */
    public function postWithHeaders(string $endpoint, array $data = [], array $headers = []): ?Response
    {
        try {
            $options = [
                'headers' => array_merge($this->getAuthHeaders(), $headers),
                'json' => $data,
            ];
            
            return $this->client->post($endpoint, $options);
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return null;
        }
    }
    
    /**
     * API yanıtını işler
     */
    private function handleResponse(Response $response): ?array
    {
        $statusCode = $response->getStatusCode();
        
        if ($statusCode >= 200 && $statusCode < 300) {
            $body = $response->getBody();
            $result = json_decode($body, true);
            