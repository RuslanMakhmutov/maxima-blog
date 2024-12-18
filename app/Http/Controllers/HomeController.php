<?php

namespace App\Http\Controllers;

use App\Helpers\CountryInfoServiceApiHelper;
use App\Helpers\OpenWeatherApiHelper;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        if (Auth::check() && $city = Auth::user()->city) {
            $helper = new OpenWeatherApiHelper();
            $air = $helper->getAirPollution($city);
        }

        $countryInfoHelper = new CountryInfoServiceApiHelper();

        return Inertia::render('Home/Home', [
            'air' => $air ?? null,
            'continents' => $countryInfoHelper->getContinentsList()
        ]);
    }
}
