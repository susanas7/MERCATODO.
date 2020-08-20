@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Detalles del producto</div>
            <div class="card-body">
                <div class="row justify-content-center">
                <img src="{{ $product->get_image }}" class="card-img-top">
                </div>&nbsp;&nbsp;
                <div class="col-md-4 text-md-center">
                    <h3>{{ $product->title }}</h3>
                    <div>
                        <h4>Precio COP {{number_format($product->price, 2)}}</h4><hr>
                        <h4><a> CARACTERISTICAS</a></h4>
                        <h4 style="text-align: justify;">{{ $product->slug }}</h4><hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection