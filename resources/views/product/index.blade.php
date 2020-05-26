@extends('layouts.app')
@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Products</h1>
    </div>

    <table class="table">
        <thead>
        <tr class="thead-dark">
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Vendor</th>
            <th scope="col">Price</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($products as $product)
            <tr>
                <th scope="row">{{ $product->id }}</th>
                <td>{{ $product->name }}</td>
                <td>{{ $product->vendor->name }}</td>
                <td>
                    <div id="product-price-{{ $product->id }}"
                         class="product-price"
                         data-productid="{{ $product->id }}"
                         data-price="{{ $product->price }}"
                         data-action="{{ route('products.update.price', $product) }}">
                        <a class="changePrice" title="Изменить цену" href="#">{{ $product->price }}</a>
                    </div>
                </td>
            </tr>
        @empty
            <tr class="text-center">
                <td colspan="5">No have product yet!</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="text-right">
        {{ $products->links() }}
    </div>


    <div id="modalChangePrice" data-method="PUT" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change price</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modalChangePriceSuccess" class="alert d-none"></div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input id="price" type="number" min="1" class="form-control">
                        <span class="hidden help-block"></span>
                        <div id="feedback_price" class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="savePrice" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection
