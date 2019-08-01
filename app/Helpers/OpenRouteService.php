<?php
namespace App\Helpers;

use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;

class OpenRouteService
{
    private $base_uri;
    private $endpoint;
    private $config;
    private $api_key;

    public function __construct($config)
    {
        $this->base_uri = config('services.open_route.base_uri');
        $this->api_key  = config('services.open_route.api_key');
        $this->setConfig($config);
    }

    public function setConfig($config)
    {
        $this->config = $config;
        $this->setUrl();
    }

    public function setUrl()
    {
        switch ($this->config['commuteType']) {
            case 'walk':
                $endpoint = '/foot-walking';
                break;
            case 'cycle':
                $endpoint = '/cycling-road';
                break;
            case 'car':
                $endpoint = '/driving-car';
                break;
        }
        $this->endpoint = $this->base_uri.$endpoint;
    }

    public function generate()
    {
        $location[] =[$this->config['lng'], $this->config['lat']];
        // dd($location);
        $client = new Client();
        $response = $client->post($this->endpoint, [
            'headers' => [
                'Authorization' => $this->api_key,
                'Content-Type'  => 'application/json'
            ],
            'json' => [
                'locations'   => $location,
                'range_type' => 'time',
                'range'      => [$this->config['time']*60],
            ]
        ]);
        if ($response->getStatusCode() == 200) {
            $body = $response->getBody();
            $data = json_decode($body);
            return $data;
        }
        return [];
    }
}
