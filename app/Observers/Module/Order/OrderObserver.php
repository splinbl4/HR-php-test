<?php

declare(strict_types=1);

namespace App\Observers\Module\Order;

use App\Events\Module\Order\OrderCompletedEvent;
use App\Module\Order\Entity\Order;

/**
 * Class OrderObserver
 * @package App\Observers\Module\Order
 */
class OrderObserver
{
    /**
     * @param Order $order
     */
    public function updated(Order $order): void
    {
        if ($order->isDirty(['status']) && $order->isCompleted()) {
            event(new OrderCompletedEvent($order));
        }
    }
}
