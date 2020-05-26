@extends('layouts.app')
@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Order № {{ $order->id }}</h1>
    </div>
    <form action="{{ route('orders.update', $order) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="client_email">Client Email</label>
                            <input id="client_email"
                                   name="client_email"
                                   type="email"
                                   class="form-control {{ $errors->has('client_email') ? 'is-invalid' : '' }}"
                                   value="{{ old('client_email') ?? $order->client_email }}">
                            @if ($errors->has('client_email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client_email') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="partner_id">Partner</label>
                            <select id="partner_id"
                                    name="partner_id"
                                    class="form-control {{ $errors->has('partner_id') ? 'is-invalid' : '' }}">
                                @foreach($partners as $partner)
                                    <option value="{{ $partner->id }}" {{ $order->partner_id === $partner->id ? 'selected' : '' }}>
                                        {{ $partner->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('partner_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('partner_id') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status"
                                    name="status"
                                    class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                @foreach($order::$statusMap as $key => $status)
                                    <option value="{{ $key }}"
                                            {{ $order->status === $key ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Order Products</div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th class="text-right">Quantity</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td class="text-right">{{ $product->pivot->quantity }}</td>
                                <td class="text-right">{{ $product->pivot->price }}</td>
                                <td class="text-right">{{ $product->pivot->quantity * $product->pivot->price }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="font-weight-bold">Total</td>
                            <td></td>
                            <td></td>
                            <td class="text-right font-weight-bold">{{ $order->getPrice() }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </div>
        </div>
    </form>
@endsection