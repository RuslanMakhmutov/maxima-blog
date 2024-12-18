<?php

namespace App\Helpers;

use App\Models\City;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class OpenWeatherApiHelper
{
    private const BASE_URL = 'https://api.openweathermap.org/';

    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('openweathermap.api_key');
    }

    public function getAirPollution(City $city): object
    {
        return Cache::remember(__FUNCTION__ . $city->id, 60, function () use ($city) {
            $response = Http::get(self::BASE_URL . "data/2.5/air_pollution", [
                'appid' => $this->apiKey,
                'lat' => $city->lat,
                'lon' => $city->lon,
            ]);

            $data = $response->object();

            return $data->list[0];
        });
    }
}
