<?php

declare(strict_types=1);

namespace App\Events\Module\Order;

use App\Module\Order\Entity\Order;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class OrderDoneEvent
 * @package App\Events\Module\Order
 */
class OrderCompletedEvent
{
    use Dispatchable, SerializesModels;

    public Order $order;

    /**
     * OrderDoneEvent constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}
