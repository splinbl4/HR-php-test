<?php

declare(strict_types=1);

namespace App\Module\Weather\Service;

use App\Module\Weather\Entity\City;

/**
 * Interface WeatherClientInterface
 * @package App\Module\Weather\Service
 */
interface WeatherClientInterface
{
    /**
     * @param City $city
     * @return int|null
     */
    public function getCurrentTemperature(City $city): ?int;
}