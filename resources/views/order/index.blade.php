@extends('layouts.app')
@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Orders</h1>
    </div>
    <ul class="nav nav-tabs">
        <li>
            <a href="{{ route('orders.index', ['type' => 'overdue', 'sort' => 'delivery_dt', 'direction' => 'desc', 'limit' => 50]) }}"
               class="nav-link @if(Request::get('type') === 'overdue') active @endif">
                Overdue
            </a>
        </li>
        <li>
            <a href="{{ route('orders.index', ['type' => 'current', 'sort' => 'delivery_dt', 'direction' => 'asc']) }}"
               class="nav-link @if(Request::get('type') === 'current' || empty(Request::get('type'))) active @endif">
                Current
            </a>
        </li>
        <li>
            <a href="{{ route('orders.index', ['type' => 'new', 'sort' => 'delivery_dt', 'direction' => 'asc', 'limit' => 50]) }}"
               class="nav-link @if(Request::get('type') === 'new') active @endif">
                New
            </a>
        </li>
        <li>
            <a href="{{ route('orders.index', ['type' => 'done', 'sort' => 'delivery_dt', 'direction' => 'desc', 'limit' => 50]) }}"
               class="nav-link @if(Request::get('type') === 'done') active @endif">
                Done
            </a>
        </li>
    </ul>
    <table class="table">
        <thead>
        <tr class="thead-dark">
            <th scope="col">ID</th>
            <th scope="col">Partner</th>
            <th scope="col">Price</th>
            <th scope="col">Order Products</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($orders as $order)
        <tr>
            <th scope="row"><a href="{{ route('orders.edit', $order) }}">{{ $order->id }}</a></th>
            <td>{{ $order->partner->name }}</td>
            <td>{{ $order->getPrice() }}</td>
            <td>
                <ul>
                    @forelse($order->products as $product)
                        <li>{{ $product->name }}</li>
                    @empty
                        <li>No products</li>
                    @endforelse
                </ul>
            </td>
            <td>{{ $order->getStatusName() }}</td>
        </tr>
        @empty
            <tr class="text-center">
                <td colspan="5">No have order yet!</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection