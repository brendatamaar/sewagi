<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Models\Country;

class CountryController extends Controller
{
    function __construct(Country $country)
    {
        $this->country = $country;
    }

    public function seeder()
    {
        $client = new Client();
        try {
            $response = $client->get("https://restcountries.com/v2/all");
            if ($response->getStatusCode() == 200) {
                $body = $response->getBody();
                $data = json_decode($body);
                $this->country->import($data);
            }
        } catch (GuzzleException $e) {
        }

    }
}
