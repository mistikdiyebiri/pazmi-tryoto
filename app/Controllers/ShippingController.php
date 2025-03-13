<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Pazmi\TryOto\TryOto;
use Config\TryOto as TryOtoConfig;

class ShippingController extends BaseController
{
    protected $tryoto;
    
    public function __construct()
    {
        // Konfigürasyon dosyasından ayarları al
        $config = new TryOtoConfig();
        
        // TryOto kütüphanesini başlat
        $this->tryoto = new TryOto([
            'api_key' => $config->apiKey,
            'api_secret' => $config->apiSecret,
            'environment' => $config->environment,
        ]);
    }
    
    public function index()
    {
        return view('shipping/index');
    }
    
    public function createShipment()
    {
        $shipmentData = [
            'sender' => [
                'name' => $this->request->getPost('sender_name'),
                'company_name' => $this->request->getPost('sender_company_name'),
                'address' => $this->request->getPost('sender_address'),
                'city' => $this->request->getPost('sender_city'),
                'district' => $this->request->getPost('sender_district'),
                'phone' => $this->request->getPost('sender_phone'),
                'email' => $this->request->getPost('sender_email')
            ],
            'recipient' => [
                'name' => $this->request->getPost('recipient_name'),
                'company_name' => $this->request->getPost('recipient_company_name'),
                'address' => $this->request->getPost('recipient_address'),
                'city' => $this->request->getPost('recipient_city'),
                'district' => $this->request->getPost('recipient_district'),
                'phone' => $this->request->getPost('recipient_phone'),
                'email' => $this->request->getPost('recipient_email')
            ],
            'parcels' => [
                [
                    'weight' => (float)$this->request->getPost('weight'),
                    'width' => (float)$this->request->getPost('width'),
                    'height' => (float)$this->request->getPost('height'),
                    'length' => (float)$this->request->getPost('length')
                ]
            ],
            'service_code' => $this->request->getPost('service_code'),
            'reference' => $this->request->getPost('reference')
        ];
        
        $result = $this->tryoto->createShipment($shipmentData);
        
        if ($result) {
            return redirect()->to('shipping/success')->with('message', 'Kargo gönderisi başarıyla oluşturuldu.');
        } else {
            return redirect()->back()->withInput()->with('error', $this->tryoto->getError());
        }
    }
    
    public function trackShipment()
    {
        $trackingNumber = $this->request->getGet('tracking_number');
        
        if (!$trackingNumber) {
            return view('shipping/track');
        }
        
        $result = $this->tryoto->trackShipment($trackingNumber);
        
        if ($result) {
            return view('shipping/track_result', ['shipment' => $result]);
        } else {
            return redirect()->back()->with('error', $this->tryoto->getError());
        }
    }
    
    public function listShipments()
    {
        $params = [
            'page' => $this->request->getGet('page', 1),
            'limit' => $this->request->getGet('limit', 10),
            'start_date' => $this->request->getGet('start_date'),
            'end_date' => $this->request->getGet('end_date')
        ];
        
        $result = $this->tryoto->listShipments($params);
        
        if ($result) {
            return view('shipping/list', ['shipments' => $result]);
        } else {
            return redirect()->back()->with('error', $this->tryoto->getError());
        }
    }
    
    public function downloadLabel($shipmentId)
    {
        $labelPdf = $this->tryoto->getShipmentLabel($shipmentId, ['size' => 'A4']);
        
        if ($labelPdf) {
            // PDF olarak indir
            return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'attachment; filename="shipping-label.pdf"')
                ->setBody($labelPdf);
        } else {
            return redirect()->back()->with('error', $this->tryoto->getError());
        }
    }
    
    public function calculateRate()
    {
        if ($this->request->getMethod() === 'post') {
            $rateData = [
                'sender_city' => $this->request->getPost('sender_city'),
                'sender_district' => $this->request->getPost('sender_district'),
                'recipient_city' => $this->request->getPost('recipient_city'),
                'recipient_district' => $this->request->getPost('recipient_district'),
                'parcels' => [
                    [
                        'weight' => (float)$this->request->getPost('weight'),
                        'width' => (float)$this->request->getPost('width'),
                        'height' => (float)$this->request->getPost('height'),
                        'length' => (float)$this->request->getPost('length')
                    ]
                ],
                'service_code' => $this->request->getPost('service_code')
            ];
            
            $result = $this->tryoto->calculateRate($rateData);
            
            if ($result) {
                return view('shipping/rate_result', ['rate' => $result]);
            } else {
                return redirect()->back()->withInput()->with('error', $this->tryoto->getError());
            }
        }
        
        // Servis listesini al
        $services = $this->tryoto->listServices();
        
        return view('shipping/calculate_rate', ['services' => $services]);
    }
}