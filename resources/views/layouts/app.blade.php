<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Shop</title>
@yield('meta')

<!-- Styles -->
    <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
</head>
<body>
<header>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
        <h5 class="my-0 mr-md-auto font-weight-normal">Shop</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="{{ route('orders.index', ['type' => 'current', 'sort' => 'delivery_dt', 'direction' => 'asc']) }}">Orders</a>
            <a class="p-2 text-dark" href="{{ route('products.index') }}">Products</a>
            <a class="p-2 text-dark" href="{{ route('weather.index') }}">Weather</a>
        </nav>
        <a class="btn btn-outline-primary" href="#">Sign up</a>
    </div>
</header>

<main class="app-content py-3" id="app">
    <div class="container">
        @include('layouts.partials.flash')
        @yield('content')
    </div>
</main>

<footer>
    <div class="container">
        <div class="border-top pt-3">
            <p>&copy; {{ date('Y') }} - Shop</p>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="{{ mix('js/app.js', 'build') }}"></script>
<script src="{{ mix('js/script.js', 'build') }}"></script>
@yield('scripts')
</body>
</html>
