@extends('layouts.app')

@section('content')

<div class="container_show">
    <div class="row">
        <div class="col-md-5">
            <img src="{{ $product->get_image }}">
        </div>
        <div class="col-md-6">
            <h2>{{ $product->title }}</h2><br><br>
            <h4>{{$product->slug}}</h4><br>
            <h3>${{number_format($product->price, 2)}}</h3><br>
            <a href="{{route('addToCart', ['id' => $product->id ])}}">Agregar</a> 
        </div>
    </div>
</div>

@endsection

<!--<div class="container">
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
</div>-->
