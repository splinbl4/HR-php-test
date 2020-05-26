<?php

declare(strict_types=1);

namespace App\Jobs\Module\Order;

use App\Mail\OrderCompleted;
use App\Module\Order\Entity\Order;
use App\Module\Vendor\Entity\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendOrderCompletedMail
 * @package App\Jobs\Module\Order
 */
class SendOrderCompletedMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $orderId;

    /**
     * SendOrderCompletedMail constructor.
     * @param int $orderId
     */
    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
    }

    public function handle(): void
    {
        $order = Order::with('partner')->find($this->orderId);
        $vendorIds = $order->products->map(function ($product) {
            return $product->vendor_id;
        });

        $vendorsEmails = Vendor::whereIn('id', $vendorIds->unique())->pluck('email');

        $vendorsEmails->merge([$order->partner->email])
            ->each(function (string $email) use ($order, &$emails) {
                Mail::to($email)->send(new OrderCompleted($order));
            });
    }
}
