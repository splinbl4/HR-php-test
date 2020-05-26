<?php

declare(strict_types=1);

namespace App\Mail;

use App\Module\Order\Entity\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class OrderCompleted
 * @package App\Mail
 */
class OrderCompleted extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;

    /**
     * OrderCompleted constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build(): OrderCompleted
    {
        return $this->view('email.order.completed')
            ->subject('Order № ' . $this->order->id . ' Completed');
    }
}
