@extends('layouts.app')
@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Weather</h1>
    </div>
    <div class="card-deck mb-3 text-center">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">{{ $weather->getCity()->getName() }}</h4>
            </div>
            <div class="card-body">
                <h4>{{ date('d.m.Y') }}</h4>
                @if ($weather->isEmptyTemp())
                    <h4 class="card-title pricing-card-title alert alert-danger">Sorry, an error has occurred</h4>
                @else
                    <h4 class="card-title pricing-card-title ">{{ $weather->getTemperature() }} <small class="text-muted">C</small></h4>
                @endif
            </div>
        </div>
    </div>
@endsection