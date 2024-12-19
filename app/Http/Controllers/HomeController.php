<?php

namespace App\Http\Controllers;

use App\Helpers\CountryInfoServiceApiHelper;
use App\Helpers\OpenWeatherApiHelper;
use App\Services\CartesianPointService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke(
        CartesianPointService $cartesianPointService,
        OpenWeatherApiHelper $openWeatherApiHelper,
        CountryInfoServiceApiHelper $countryInfoHelper
    ) {
        if (Auth::check() && $city = Auth::user()->city) {
            $air = $openWeatherApiHelper->getAirPollution($city);
        }

        return Inertia::render('Home/Home', [
            'air' => $air ?? null,
            'continents' => $countryInfoHelper->getContinentsList(),
            'points' => $cartesianPointService->closestTo(0.5, 0.5, 0.01)
        ]);
    }
}
