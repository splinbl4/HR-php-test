<h2>Order №{{ $order->id }} completed</h2>
<h4>Order Products</h4>
<table>
    <thead>
    <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->pivot->quantity }}</td>
            <td>{{ $product->pivot->price }}</td>
            <td>{{ $product->pivot->quantity * $product->pivot->price }}</td>
        </tr>
    @endforeach
    <tr>
        <td>Total</td>
        <td></td>
        <td></td>
        <td>{{ $order->getPrice() }}</td>
    </tr>
    </tbody>
</table>