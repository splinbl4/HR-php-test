<?php

declare(strict_types=1);

namespace App\Module\Weather\Entity;

/**
 * Class City
 * @package App\Module\Weather\Entity
 */
class City
{
    private string $name;

    private Coordinates $coordinates;

    /**
     * City constructor.
     * @param string $name
     * @param Coordinates $coordinates
     */
    public function __construct(string $name, Coordinates $coordinates)
    {
        $this->name = $name;
        $this->coordinates = $coordinates;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Coordinates
     */
    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }
}
