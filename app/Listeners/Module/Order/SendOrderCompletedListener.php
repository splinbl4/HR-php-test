<?php

declare(strict_types=1);

namespace App\Listeners\Module\Order;

use App\Events\Module\Order\OrderCompletedEvent;
use App\Jobs\Module\Order\SendOrderCompletedMail;

/**
 * Class SendOrderCompletedNotification
 * @package App\Listeners\Module\Order
 */
class SendOrderCompletedListener
{
    /**
     * @param OrderCompletedEvent $event
     */
    public function handle(OrderCompletedEvent $event): void
    {
        SendOrderCompletedMail::dispatch($event->order->id);
    }
}
