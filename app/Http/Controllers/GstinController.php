<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GstinController extends Controller
{
    public function getGstinDetails($gstin)
    {
        $client = new Client();

        try {
            // Make the request to the GSTIN API
            $response = $client->request('GET', 'https://api.cleartax.in/gstin/v1/' . $gstin, [
                'headers' => [
                    'x-cleartax-auth-token' => env('CLEARTAX_API_KEY'),
                    'Accept' => 'application/json',
                ],
            ]);

            // Decode the response
            $data = json_decode($response->getBody(), true);

            // Extract the required details
            $address = $data['address'] ?? '';
            $city = $data['city'] ?? '';
            $pincode = $data['pincode'] ?? '';
            $country = $data['country'] ?? '';

            // Return the response as JSON
            return response()->json([
                'gstin' => $gstin,
                'address' => $address,
                'city' => $city,
                'pincode' => $pincode,
                'country' => $country,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch details', 'message' => $e->getMessage()], 500);
        }
    }
}
