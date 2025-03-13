<?php

namespace Pazmi\TryOto;

use Pazmi\TryOto\Common\ApiClient;
use Pazmi\TryOto\Auth\AuthManager;
use Pazmi\TryOto\Account\AccountManager;
use Pazmi\TryOto\Order\OrderManager;
use Pazmi\TryOto\Shipment\ShipmentManager;
use Pazmi\TryOto\ReturnShipment\ReturnShipmentManager;
use Pazmi\TryOto\Label\LabelManager;
use Pazmi\TryOto\Tracking\TrackingManager;
use Pazmi\TryOto\Carrier\CarrierManager;
use Pazmi\TryOto\Pickup\PickupManager;
use Pazmi\TryOto\Brand\BrandManager;
use Pazmi\TryOto\Product\ProductManager;
use Pazmi\TryOto\Stock\StockManager;
use Pazmi\TryOto\Webhook\WebhookManager;
use Pazmi\TryOto\OtoFlex\OtoFlexManager;
use Pazmi\TryOto\Common\StatusCodes;
use Pazmi\TryOto\Common\ErrorCodes;
use Pazmi\TryOto\Address\AddressManager;
use Pazmi\TryOto\Route\RouteManager;
use Pazmi\TryOto\Report\ReportManager;
use Pazmi\TryOto\Payment\PaymentManager;

/**
 * TryOto API Kütüphanesi
 * 
 * TryOto kargo firması API'si için CodeIgniter 4 uyumlu kütüphane
 * @version 1.0.0
 * @author Pazmi
 * @link https://tryoto.com
 */
class TryOto
{
    /**
     * API istemcisi
     *
     * @var ApiClient
     */
    private $apiClient;
    
    /**
     * Alt kategori yöneticileri
     */
    private $authManager;
    private $accountManager;
    private $orderManager;
    private $shipmentManager;
    private $returnShipmentManager;
    private $labelManager;
    private $trackingManager;
    private $carrierManager;
    private $pickupManager;
    private $brandManager;
    private $productManager;
    private $stockManager;
    private $webhookManager;
    private $otoFlexManager;
    private $addressManager;
    private $routeManager;
    private $reportManager;
    private $paymentManager;
    
    /**
     * Sınıf yapılandırması
     */
    public function __construct(array $config = [])
    {
        // API istemcisini yapılandır
        $this->apiClient = new ApiClient($config);
        
        // Alt kategori yöneticilerini başlat
        $this->authManager = new AuthManager($this->apiClient);
        $this->accountManager = new AccountManager($this->apiClient);
        $this->orderManager = new OrderManager($this->apiClient);
        $this->shipmentManager = new ShipmentManager($this->apiClient);
        $this->returnShipmentManager = new ReturnShipmentManager($this->apiClient);
        $this->labelManager = new LabelManager($this->apiClient);
        $this->trackingManager = new TrackingManager($this->apiClient);
        $this->carrierManager = new CarrierManager($this->apiClient);
        $this->pickupManager = new PickupManager($this->apiClient);
        $this->brandManager = new BrandManager($this->apiClient);
        $this->productManager = new ProductManager($this->apiClient);
        $this->stockManager = new StockManager($this->apiClient);
        $this->webhookManager = new WebhookManager($this->apiClient);
        $this->otoFlexManager = new OtoFlexManager($this->apiClient);
        $this->addressManager = new AddressManager($this->apiClient);
        $this->routeManager = new RouteManager($this->apiClient);
        $this->reportManager = new ReportManager($this->apiClient);
        $this->paymentManager = new PaymentManager($this->apiClient);
    }
    
    /**
     * Son hatayı döndürür
     */
    public function getError(): string
    {
        return $this->apiClient->getError();
    }

    /**
     * Durum açıklamasını verir
     */
    public function getStatusMessage(string $statusCode, string $type = 'order'): string 
    {
        switch (strtolower($type)) {
            case 'order':
                return StatusCodes::getOrderStatus($statusCode);
            case 'shipment':
                return StatusCodes::getShipmentStatus($statusCode);
            case 'return':
                return StatusCodes::getReturnStatus($statusCode);
            case 'stock':
                return StatusCodes::getStockStatus($statusCode);
            case 'payment':
                return StatusCodes::getPaymentStatus($statusCode);
            default:
                return 'Bilinmeyen durum tipi';
        }
    }
    
    /**
     * Hata açıklamasını verir
     */
    public function getErrorMessage(string $errorCode): string
    {
        return ErrorCodes::getMessage($errorCode);
    }
    
    /*
     * Yetkilendirme İşlemleri (Authorization)
     */
    
    /**
     * Yetkilendirme yapar
     */
    public function authorize(array $credentials): ?array
    {
        return $this->authManager->authorize($credentials);
    }
    
    /**
     * Token yeniler
     */
    public function refreshToken(string $refreshToken): ?array
    {
        return $this->authManager->refreshToken($refreshToken);
    }
    
    /**
     * Sağlık kontrolü yapar
     */
    public function healthCheck(): ?array
    {
        return $this->authManager->healthCheck();
    }
    
    /*
     * Hesap İşlemleri (Account)
     */
    
    /**
     * Hesap kaydı yapar
     */
    public function register(array $userData): ?array
    {
        return $this->accountManager->register($userData);
    }
    
    /**
     * Müşteri bilgilerini getirir
     */
    public function getClientInfo(): ?array
    {
        return $this->accountManager->getClientInfo();
    }
    
    /**
     * Müşteri bilgilerini günceller
     */
    public function updateClientInfo(array $clientData): ?array
    {
        return $this->accountManager->updateClientInfo($clientData);
    }
    
    /**
     * OTO kredi satın alır
     */
    public function buyOtoCredit(array $creditData): ?array
    {
        return $this->accountManager->buyOtoCredit($creditData);
    }
    
    /**
     * Kargo kredisi satın alır
     */
    public function buyShippingCredit(array $creditData): ?array
    {
        return $this->accountManager->buyShippingCredit($creditData);
    }
    
    /**
     * Kredi işlemlerini listeler
     */
    public function getCreditTransactions(array $params = []): ?array
    {
        return $this->accountManager->getCreditTransactions($params);
    }

    /**
     * Bakiye bilgisini getirir
     */
    public function getBalance(): ?array
    {
        return $this->accountManager->getBalance();
    }
    
    /**
     * Kullanıcı şifresini değiştirir
     */
    public function changePassword(string $oldPassword, string $newPassword): ?array
    {
        return $this->accountManager->changePassword($oldPassword, $newPassword);
    }
    
    /**
     * Şifre sıfırlama linki gönderir
     */
    public function requestPasswordReset(string $email): ?array
    {
        return $this->accountManager->requestPasswordReset($email);
    }
    
    /**
     * Şifre sıfırlama işlemini tamamlar
     */
    public function resetPassword(string $token, string $newPassword): ?array
    {
        return $this->accountManager->resetPassword($token, $newPassword);
    }
    
    /*
     * Sipariş İşlemleri (Orders)
     */
    
    /**
     * Sipariş oluşturur
     */
    public function createOrder(array $orderData): ?array
    {
        return $this->orderManager->createOrder($orderData);
    }
    
    /**
     * Siparişi günceller
     */
    public function updateOrder(array $orderData): ?array
    {
        return $this->orderManager->updateOrder($orderData);
    }
    
    /**
     * Sipariş durumunu günceller
     */
    public function updateOrderStatus(array $statusData): ?array
    {
        return $this->orderManager->updateOrderStatus($statusData);
    }
    
    /**
     * Siparişi iptal eder
     */
    public function cancelOrder(string $orderId): ?array
    {
        return $this->orderManager->cancelOrder($orderId);
    }
    
    /**
     * Siparişleri listeler
     */
    public function getOrders(array $params = []): ?array
    {
        return $this->orderManager->getOrders($params);
    }
    
    /**
     * Sipariş detaylarını getirir
     */
    public function getOrderDetails(string $orderId): ?array
    {
        return $this->orderManager->getOrderDetails($orderId);
    }
    
    /**
     * Siparişi bekletmeye alır
     */
    public function holdOrder(string $orderId, array $holdData = []): ?array
    {
        return $this->orderManager->holdOrder($orderId, $holdData);
    }
    
    /**
     * Siparişi bekletmeden çıkarır
     */
    public function unholdOrder(string $orderId): ?array
    {
        return $this->orderManager->unholdOrder($orderId);
    }

    /**
     * Sipariş durumlarını listeler
     */
    public function getOrderStatuses(): ?array
    {
        return $this->orderManager->getOrderStatuses();
    }

    /**
     * Sipariş iş akışlarını listeler
     */
    public function getOrderFlows(): ?array
    {
        return $this->orderManager->getOrderFlows();
    }
    
    /**
     * Toplu sipariş oluşturur
     */
    public function createBulkOrder(array $orders): ?array
    {
        return $this->orderManager->createBulkOrder($orders);
    }
    
    /**
     * Siparişi onaylar
     */
    public function confirmOrder(string $orderId): ?array
    {
        return $this->orderManager->confirmOrder($orderId);
    }
    
    /**
     * Sipariş notlarını getirir
     */
    public function getOrderNotes(string $orderId): ?array
    {
        return $this->orderManager->getOrderNotes($orderId);
    }
    
    /**
     * Siparişe not ekler
     */
    public function addOrderNote(string $orderId, string $note): ?array
    {
        return $this->orderManager->addOrderNote($orderId, $note);
    }
    
    /*
     * Kargo İşlemleri (Shipment)
     */
    
    /**
     * Kargo gönderi oluşturur
     */
    public function createShipment(array $shipmentData): ?array
    {
        return $this->shipmentManager->createShipment($shipmentData);
    }
    
    /**
     * Gönderiyi iptal eder
     */
    public function cancelShipment(string $shipmentId): ?array
    {
        return $this->shipmentManager->cancelShipment($shipmentId);
    }
    
    /**
     * Gönderi işlemlerini listeler
     */
    public function getShipmentTransactions(array $params = []): ?array
    {
        return $this->shipmentManager->getShipmentTransactions($params);
    }
    
    /**
     * Kargo ücret işlemlerini listeler
     */
    public function getShippingPriceTransactions(array $params = []): ?array
    {
        return $this->shipmentManager->getShippingPriceTransactions($params);
    }

    /**
     * Gönderileri listeler
     */
    public function getShipments(array $params = []): ?array
    {
        return $this->shipmentManager->getShipments($params);
    }

    /**
     * Gönderi detaylarını getirir
     */
    public function getShipment(string $shipmentId): ?array
    {
        return $this->shipmentManager->getShipment($shipmentId);
    }

    /**
     * Teslimat durumunu günceller
     */
    public function updateDeliveryStatus(string $shipmentId, string $status, array $additionalData = []): ?array
    {
        return $this->shipmentManager->updateDeliveryStatus($shipmentId, $status, $additionalData);
    }

    /**
     * Gönderi durumlarını listeler
     */
    public function getShipmentStatuses(): ?array
    {
        return $this->shipmentManager->getShipmentStatuses();
    }
    
    /**
     * Toplu gönderi oluşturur
     */
    public function createBulkShipment(array $shipments): ?array
    {
        return $this->shipmentManager->createBulkShipment($shipments);
    }
    
    /**
     * Kargo ücreti hesaplar
     */
    public function calculateShippingRate(array $rateData): ?array
    {
        return $this->shipmentManager->calculateShippingRate($rateData);
    }
    
    /*
     * İade Gönderileri İşlemleri (Return Shipments)
     */
    
    /**
     * İade gönderi oluşturur
     */
    public function createReturnShipment(array $returnData): ?array
    {
        return $this->returnShipmentManager->createReturnShipment($returnData);
    }
    
    /**
     * İade linki getirir
     */
    public function getReturnLink(array $linkData): ?array
    {
        return $this->returnShipmentManager->getReturnLink($linkData);
    }
    
    /**
     * İade detaylarını getirir
     */
    public function getReturnDetails(string $returnId): ?array
    {
        return $this->returnShipmentManager->getReturnDetails($returnId);
    }
    
    /**
     * İade SMS'i tetikler
     */
    public function triggerReturnSMS(array $smsData): ?array
    {
        return $this->returnShipmentManager->triggerReturnSMS($smsData);
    }

    /**
     * İade işlemlerini listeler
     */
    public function getReturnShipments(array $params = []): ?array
    {
        return $this->returnShipmentManager->getReturnShipments($params);
    }

    /**
     * İade durumunu günceller
     */
    public function updateReturnStatus(string $returnId, string $status): ?array
    {
        return $this->returnShipmentManager->updateReturnStatus($returnId, $status);
    }
    
    /**
     * İade etiketini getirir
     */
    public function getReturnLabel(string $returnId, array $params = []): ?string
    {
        return $this->returnShipmentManager->getReturnLabel($returnId, $params);
    }
    
    /*
     * Etiket İşlemleri (Shipping Label)
     */
    
    /**
     * Gönderi etiketini getirir (AWB)
     */
    public function printAWB(string $shipmentId, array $params = []): ?string
    {
        return $this->labelManager->printAWB($shipmentId, $params);
    }

    /**
     * Toplu gönderi etiketi oluşturur
     */
    public function printBulkAWB(array $shipmentIds, array $params = []): ?string
    {
        return $this->labelManager->printBulkAWB($shipmentIds, $params);
    }

    /**
     * Etiket formatlarını listeler
     */
    public function getLabelFormats(): ?array
    {
        return $this->labelManager->getLabelFormats();
    }
    
    /**
     * Manifesto oluşturur
     */
    public function generateManifest(array $shipmentIds, array $params = []): ?string
    {
        return $this->labelManager->generateManifest($shipmentIds, $params);
    }
    
    /**
     * Ticari fatura oluşturur
     */
    public function generateCommercialInvoice(string $shipmentId): ?string
    {
        return $this->labelManager->generateCommercialInvoice($shipmentId);
    }
    
    /*
     * Takip İşlemleri (Tracking)
     */
    
    /**
     * Sipariş takibi yapar
     */
    public function trackOrder(string $orderId): ?array
    {
        return $this->trackingManager->trackOrder($orderId);
    }
    
    /**
     * Sipariş geçmişini getirir
     */
    public function getOrderHistory(string $orderId): ?array
    {
        return $this->trackingManager->getOrderHistory($orderId);
    }
    
    /**
     * Gönderi takibi yapar
     */
    public function trackShipment(string $trackingNumber): ?array
    {
        return $this->trackingManager->trackShipment($trackingNumber);
    }

    /**
     * Çoklu gönderi takibi yapar
     */
    public function trackMultipleShipments(array $trackingNumbers): ?array
    {
        return $this->trackingManager->trackMultipleShipments($trackingNumbers);
    }

    /**
     * Tarih aralığına göre gönderi takibi yapar
     */
    public function trackShipmentsByDateRange(string $startDate, string $endDate): ?array
    {
        return $this->trackingManager->trackShipmentsByDateRange($startDate, $endDate);
    }
    
    /**
     * İade takibi yapar
     */
    public function trackReturn(string $returnId): ?array
    {
        return $this->trackingManager->trackReturn($returnId);
    }
    
    /**
     * Takip URL'si oluşturur
     */
    public function generateTrackingUrl(string $trackingNumber): string
    {
        return $this->trackingManager->generateTrackingUrl($trackingNumber);
    }
    
    /*
     * Adres İşlemleri (Address)
     */
    
    /**
     * Adres doğrulama yapar
     */
    public function validateAddress(array $addressData): ?array
    {
        return $this->addressManager->validateAddress($addressData);
    }
    
    /**
     * Ülkeleri listeler
     */
    public function getCountries(): ?array
    {
        return $this->addressManager->getCountries();
    }
    
    /**
     * İlleri listeler
     */
    public function getProvinces(string $countryCode = 'TR'): ?array
    {
        return $this->addressManager->getProvinces($countryCode);
    }
    
    /**
     * İlçeleri listeler
     */
    public function getDistricts(string $provinceCode): ?array
    {
        return $this->addressManager->getDistricts($provinceCode);
    }
    
    /**
     * Mahalleleri listeler
     */
    public function getNeighborhoods(string $districtCode): ?array
    {
        return $this->addressManager->getNeighborhoods($districtCode);
    }
    
    /**
     * Postakoduyla adres sorgular
     */
    public function lookupPostcode(string $postcode): ?array
    {
        return $this->addressManager->lookupPostcode($postcode);
    }
    
    /*
     * Taşıyıcı Entegrasyon İşlemleri (Carrier Integrations)
     */
    
    /**
     * OTO teslimat ücretini kontrol eder
     */
    public function checkOtoDeliveryFee(array $checkData): ?array
    {
        return $this->carrierManager->checkOtoDeliveryFee($checkData);
    }
    
    /**
     * Teslimat ücretini kontrol eder
     */
    public function checkDeliveryFee(array $checkData): ?array
    {
        return $this->carrierManager->checkDeliveryFee($checkData);
    }
    
    /**
     * Teslimat ücretini getirir
     */
    public function getDeliveryFee(array $feeData): ?array
    {
        return $this->carrierManager->getDeliveryFee($feeData);
    }
    
    /**
     * Teslimat tahmini getirir
     */
    public function getDeliveryEstimation(array $estimationData): ?array
    {
        return $this->carrierManager->getDeliveryEstimation($estimationData);
    }
    
    /**
     * Kapsama alanını kontrol eder
     */
    public function checkCoverage(array $coverageData): ?array
    {
        return $this->carrierManager->checkCoverage($coverageData);
    }
    
    /**
     * Mevcut şehirleri getirir
     */
    public function getAvailableCities(): ?array
    {
        return $this->carrierManager->getAvailableCities();
    }
    
    /**
     * Mevcut zaman dilimlerini getirir
     */
    public function getAvailableTimeSlots(array $slotData): ?array
    {
        return $this->carrierManager->getAvailableTimeSlots($slotData);
    }
    
    /**
     * Dağıtım merkezi listesini getirir
     */
    public function getDCList(): ?array
    {
        return $this->carrierManager->getDCList();
    }
    
    /**
     * Dağıtım merkezi yapılandırmasını getirir
     */
    public function getDCConfig(string $dcId): ?array
    {
        return $this->carrierManager->getDCConfig($dcId);
    }
    
    /**
     * Dağıtım merkezi aktivasyonunu yapar
     */
    public function activateDC(string $dcId, array $activationData = []): ?array
    {
        return $this->carrierManager->activateDC($dcId, $activationData);
    }
    
    /**
     * Teslimat seçeneklerini getirir
     */
    public function getDeliveryOptions(array $optionData = []): ?array
    {
        return $this->carrierManager->getDeliveryOptions($optionData);
    }
    
    /**
     * Şehirleri getirir
     */
    public function getCities(array $params = []): ?array
    {
        return $this->carrierManager->getCities($params);
    }

    /**
     * Taşıyıcıları listeler
     */
    public function getCarriers(): ?array
    {
        return $this->carrierManager->getCarriers();
    }

    /**
     * Taşıyıcı servisleri listeler
     */
    public function getCarrierServices(string $carrierId): ?array
    {
        return $this->carrierManager->getCarrierServices($carrierId);
    }
    
    /**
     * Karşılaştırmalı teslimat ücretlerini getirir
     */
    public function getComparisonRates(array $shipmentData): ?array
    {
        return $this->carrierManager->getComparisonRates($shipmentData);
    }
    
    /*
     * Toplama Noktası İşlemleri (Pickup Locations)
     */
    
    /**
     * Toplama noktası oluşturur
     */
    public function createPickupLocation(array $locationData): ?array
    {
        return $this->pickupManager->createPickupLocation($locationData);
    }
    
    /**
     * Toplama noktasını günceller
     */
    public function updatePickupLocation(string $locationId, array $locationData): ?array
    {
        return $this->pickupManager->updatePickupLocation($locationId, $locationData);
    }
    
    /**
     * Toplama noktalarını listeler
     */
    public function getPickupLocations(array $params = []): ?array
    {
        return $this->pickupManager->getPickupLocations($params);
    }

    /**
     * Toplama noktası detaylarını getirir
     */
    public function getPickupLocationDetails(string $locationId): ?array
    {
        return $this->pickupManager->getPickupLocationDetails($locationId);
    }

    /**
     * Toplama noktasını siler
     */
    public function deletePickupLocation(string $locationId): ?array
    {
        return $this->pickupManager->deletePickupLocation($locationId);
    }

    /**
     * Toplama talebinde bulunur
     */
    public function requestPickup(array $requestData): ?array
    {
        return $this->pickupManager->requestPickup($requestData);
    }

    /**
     * Toplama taleplerini listeler
     */
    public function getPickupRequests(array $params = []): ?array
    {
        return $this->pickupManager->getPickupRequests($params);
    }
    
    /**
     * Toplama noktası durumunu günceller
     */
    public function updatePickupStatus(string $requestId, string $status): ?array
    {
        return $this->pickupManager->updatePickupStatus($requestId, $status);
    }
    
    /*
     * Marka İşlemleri (Brands)
     */
    
    /**
     * Müşteri mağazasındaki markaları listeler
     */
    public function getBrands(): ?array
    {
        return $this->brandManager->getBrands();
    }
    
    /**
     * Müşteri mağazasında marka oluşturur
     */
    public function createBrand(array $brandData): ?array
    {
        return $this->brandManager->createBrand($brandData);
    }

    /**
     * Markayı günceller
     */
    public function updateBrand(string $brandId, array $brandData): ?array
    {
        return $this->brandManager->updateBrand($brandId, $brandData);
    }

    /**
     * Markayı siler
     */
    public function deleteBrand(string $brandId): ?array
    {
        return $this->brandManager->deleteBrand($brandId);
    }
    
    /*
     * Ürün İşlemleri (Products)
     */
    
    /**
     * Ürün oluşturur
     */
    public function createProduct(array $productData): ?array
    {
        return $this->productManager->createProduct($productData);
    }
    
    /**
     * Ürünleri listeler
     */
    public function getProducts(array $params = []): ?array
    {
        return $this->productManager->getProducts($params);
    }

    /**
     * Ürün günceller
     */
    public function updateProduct(string $productId, array $productData): ?array
    {
        return $this->productManager->updateProduct($productId, $productData);
    }

    /**
     * Ürünü siler
     */
    public function deleteProduct(string $productId): ?array
    {
        return $this->productManager->deleteProduct($productId);
    }
    
    /**
     * Kutu ekler
     */
    public function addBox(array $boxData): ?array
    {
        return $this->productManager->addBox($boxData);
    }
    
    /**
     * Kutu günceller
     */
    public function updateBox(string $boxId, array $boxData): ?array
    {
        return $this->productManager->updateBox($boxId, $boxData);
    }
    
    /**
     * Kutu bilgisini getirir
     */
    public function getBox(string $boxId): ?array
    {
        return $this->productManager->getBox($boxId);
    }

    /**
     * Kutuları listeler
     */
    public function getBoxes(array $params = []): ?array
    {
        return $this->product