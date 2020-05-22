<?php

declare(strict_types=1);

namespace App\Module\Weather\Entity;

/**
 * Class Coordinate
 * @package App\Module\Weather\Entity
 */
class Coordinates
{
    private float $lat;
    private float $lon;

    /**
     * Coordinates constructor.
     * @param float $lat
     * @param float $lon
     */
    public function __construct(float $lat, float $lon)
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }

    /**
     * @return float
     */
    public function getLat(): float
    {
        return $this->lat;
    }

    /**
     * @return float
     */
    public function getLon(): float
    {
        return $this->lon;
    }
}
