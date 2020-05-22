<?php

declare(strict_types=1);

namespace App\Http\Controllers\Weather;

use App\Http\Controllers\Controller;
use App\Module\Weather\Entity\City;
use App\Module\Weather\Entity\Coordinates;
use App\Module\Weather\Entity\Weather;
use App\Module\Weather\Service\WeatherClientInterface;

/**
 * Class WeatherController
 * @package App\Http\Controllers
 */
class WeatherController extends Controller
{
    private WeatherClientInterface $weatherClient;

    /**
     * WeatherController constructor.
     * @param WeatherClientInterface $weatherClient
     */
    public function __construct(WeatherClientInterface $weatherClient)
    {
        $this->weatherClient = $weatherClient;
    }

    public function index()
    {
        $city = new City('Брянск', new Coordinates(53.243562, 34.363407));
        $temperature = $this->weatherClient->getCurrentTemperature($city);
        $weather = new Weather($city, $temperature);

        return view('weather.index', compact('weather'));
    }
}
