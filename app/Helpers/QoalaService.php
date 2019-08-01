<?php
namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use function GuzzleHttp\json_decode;

class QoalaService
{
    private $base_uri;
    private $endpoint;
    private $type;
    private $api_key_bank;
    private $api_key_ktp;

    public function __construct($type)
    {
        $this->base_uri = config('services.qoala.base_uri');
        $this->api_key_bank  = config('services.qoala.api_key_bank');
        $this->api_key_ktp  = config('services.qoala.api_key_ktp');
        $this->setType($type);
    }

    public function setType($type)
    {
        $this->type = $type;
        $this->setUrl();
    }

    public function setUrl()
    {
        switch ($this->type) {
            case 'ktp':
                $endpoint = 'check-ktp';
                break;
            case 'bank':
                $endpoint = 'bank-inquiry';
                break;
        }
        $this->endpoint = $this->base_uri.$endpoint;
    }

    public function sendData($type, $body)
    {
        $auth = $type == 'bank' ? $this->api_key_bank : $this->api_key_ktp;
        $client = new Client();
        $options = [
            'headers' => [
                'x-api-key' => $auth,
                'Content-Type'  => 'application/json'
            ],
            'json' => $body
        ];

        try {
            $response = $client->post($this->endpoint, $options);
            $body = json_decode($response->getBody()); 
            if ($response->getStatusCode() == 200) {
                return [
                    'status' => true,
                    'message' => '',
                    'data' => $body->data
                ];
            }

            return [
                'status' => false,
                'message' => $body->data
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
