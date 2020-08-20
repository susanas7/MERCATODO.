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
