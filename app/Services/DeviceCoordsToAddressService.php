<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Device;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;

class DeviceCoordsToAddressService
{
    private HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function geocode(Device $device): void
    {
        $url = sprintf(
            'https://maps.googleapis.com/maps/api/geocode/json?latlng=%s,%s&key=%s',
            $device->latitude,
            $device->longitude,
            config('app.google_api_key')
        );
        $promise = $this->httpClient->getAsync($url);
        $promise->then(
            function (ResponseInterface $response) use ($device) {
                Log::debug("Reverse geocoding successful for device: {$device->id}");
                $response = json_decode($response->getBody()->getContents(), true);
                $device->address = $response['results'][0]['formatted_address'];
                $device->save();
            },
            function (RequestException $exception) use ($device) {
                Log::debug("Reverse geocoding FAILED for device: {$device->id}. " . $exception->getMessage());
            }
        );
        $promise->wait();
    }
}
