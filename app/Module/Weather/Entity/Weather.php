<?php

declare(strict_types=1);

namespace App\Module\Weather\Entity;

/**
 * Class Weather
 * @package App\Module\Weather\Entity
 */
class Weather
{
    private City $city;

    private ?int $temperature;

    /**
     * Weather constructor.
     * @param City $city
     * @param int $temperature
     */
    public function __construct(City $city, int $temperature = null)
    {
        $this->city = $city;
        $this->temperature = $temperature;
    }

    /**
     * @return City
     */
    public function getCity(): City
    {
        return $this->city;
    }

    /**
     * @return int|null
     */
    public function getTemperature(): ?int
    {
        return $this->temperature;
    }

    /**
     * @param int $temperature
     */
    public function setTemperature(?int $temperature): void
    {
        $this->temperature = $temperature;
    }

    /**
     * @return bool
     */
    public function isEmptyTemp(): bool
    {
        return empty($this->temperature);
    }
}
