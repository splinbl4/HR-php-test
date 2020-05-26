<?php

declare(strict_types=1);

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Request\Module\Order\OrderUpdateRequest;
use App\Mail\OrderCompleted;
use App\Module\Order\Entity\Order;
use App\Module\Order\ReadModel\Order\Filter;
use App\Module\Order\ReadModel\Order\OrderFetcher;
use App\Module\Partner\Entity\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

/**
 * Class OrderController
 * @package App\Http\Controllers\Order
 */
class OrderController extends Controller
{
    private OrderFetcher $fetcher;

    /**
     * OrderController constructor.
     * @param OrderFetcher $fetcher
     */
    public function __construct(OrderFetcher $fetcher)
    {
        $this->fetcher = $fetcher;
    }

    public function index(Request $request): View
    {
        $filter = Filter::forType($request->query->get('type', 'current'));

        $orders = $this->fetcher->all(
            $filter,
            $request->query->get('sort', 'delivery_dt'),
            $request->query->get('direction', 'asc'),
            (int)$request->query->get('limit')
        );

        return view('order.index', compact('orders'));
    }

    public function edit(int $id): View
    {
        $order = Order::findOrFail($id);
        $partners = Partner::all();
        return view('order.edit', compact('order', 'partners'));
    }

    public function update(OrderUpdateRequest $request, int $id)
    {
        /** @var Order $order **/
        $order = Order::findOrFail($id);
        $order->update($request->validated());
        Mail::to('sbykov@htc-cs.ru')->send(new OrderCompleted($order));
        return redirect()
            ->route('orders.edit', $order)
            ->with('success', 'Order № ' . $order->id . ' successfully saved');
    }
}
