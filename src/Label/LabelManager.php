<?php

namespace Pazmi\TryOto\Label;

use Pazmi\TryOto\Common\ApiClient;
use Exception;

/**
 * Etiket İşlemleri Yöneticisi
 */
class LabelManager
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
     * Gönderi etiketini getirir (AWB)
     * 
     * @param string $shipmentId Gönderi ID
     * @param array $params Parametre
     * @return string|null PDF içeriği
     */
    public function printAWB(string $shipmentId, array $params = []): ?string
    {
        try {
            $response = $this->apiClient->getWithHeaders('labels/awb/' . $shipmentId, $params, [
                'Accept' => 'application/pdf',
            ]);
            
            if ($response && $response->getStatusCode() === 200) {
                return $response->getBody();
            }
            
            return null;
        } catch (Exception $e) {
            return null;
        }
    }
    
    /**
     * Toplu gönderi etiketi oluşturur
     * 
     * @param array $shipmentIds Gönderi ID'leri
     * @param array $params Parametreler
     * @return string|null PDF içeriği
     */
    public function printBulkAWB(array $shipmentIds, array $params = []): ?string
    {
        try {
            $data = array_merge(['shipment_ids' => $shipmentIds], $params);
            $response = $this->apiClient->postWithHeaders('labels/bulk-awb', $data, [
                'Accept' => 'application/pdf',
            ]);
            
            if ($response && $response->getStatusCode() === 200) {
                return $response->getBody();
            }
            
            return null;
        } catch (Exception $e) {
            return null;
        }
    }
    
    /**
     * Etiket formatlarını listeler
     * 
     * @return array|null
     */
    public function getLabelFormats(): ?array
    {
        return $this->apiClient->get('labels/formats');
    }
}