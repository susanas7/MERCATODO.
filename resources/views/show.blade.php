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
            @if(auth()->user())
                <a href="{{route('user.addToCart', ['id' => $product->id ])}}">add +</a> 
            @endif
        </div>
    </div>
</div><br>
<h5>Te puede interesar</h5><br>
<div class="container-show-random">
    @foreach($collection as $p) 
    <div class="container-show-random-products">
    <a href="{{route('home.show', $product->id) }}">
        <img src="{{$p->get_image}}"></a>
        <a href="{{route('home.show', $product->id) }}" class="btn btn">
        <h1>{{$p->title}}</h1>
        <h6>{{$p->price}}</h6></a>
    </div>
    @endforeach      
</div>
@endsection
