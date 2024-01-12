<?php
// app/Services/PropertyService.php

namespace App\Services;
use GuzzleHttp\Client;

use App\Repositories\GenerateGISIDRepository;

class GetPincodeService
{

    public function getPincode($latitude, $longitude)
    {
        $apiKey = config('services.google_maps.key');
        $client = new Client();

        // Make a request to the Google Maps Geocoding API
        $response = $client->get('https://maps.googleapis.com/maps/api/geocode/json', [
            'query' => [
                'latlng' => $latitude . ',' . $longitude,
                'key' => $apiKey,
                'callback' => 'initMap',
            ],
        ]);

        // Parse the JSON response
        $data = json_decode($response->getBody(), true);

        // Check if the response contains results
        if (isset($data['results'][0]['address_components'])) {
            foreach ($data['results'][0]['address_components'] as $component) {
                if (in_array('postal_code', $component['types'])) {
                    return $component['long_name']; // Postal code (pincode)
                }
            }
        }

        return null; // Pincode not found
    }

}
