@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"> Bienvenido</div>
            <div class="card-header">Productos</div>
            <div class="card-header justify-content-center">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-4 tect-md-center">
                            <img src="{{ URL::to('/images/' . $product->img_route) }}" width="300" >
                            <!--<img src="images/{{$product->img_route}}" width="75">-->
                            <h4>{{ $product->title }}</h4>
                            <h4>Precio COP {{ $product->price }} </h4>
                            <a class="btn btn-primary" href="{{route('home.show', $product->id)}}">Detalles</a>
                        </div>
                    @endforeach
                </div>
            </div>                    
        </div>
    </div>
</div>
{{$products->links()}}
@endsection
