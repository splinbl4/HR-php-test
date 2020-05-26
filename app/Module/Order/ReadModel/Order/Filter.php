<?php

declare(strict_types=1);

namespace App\Module\Order\ReadModel\Order;

/**
 * Class Filter
 * @package App\Module\Order\ReadModel\Order
 */
class Filter
{
    public ?string $type = null;

    private function __construct(?string $type)
    {
        $this->type = $type;
    }

    public static function all(): self
    {
        return new self(null);
    }

    public static function forType(string $type): self
    {
        return new self($type);
    }
}
