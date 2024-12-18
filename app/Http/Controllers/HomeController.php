<?php

namespace App\Http\Controllers;

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
        return Inertia::render('Home/Home', [
            'air' => $air ?? null,
        ]);
    }
}
