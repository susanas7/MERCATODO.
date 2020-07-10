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
                            <a class="btn btn-primary" data-toggle="modal" data-target="#{{$product->title}}" >Detalles</a>
                            <!--ventana emergente-->
                            <div class="modal fade" id="{{$product->title}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="muModalLabel">{{$product->title}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ URL::to('/images/' . $product->img_route) }}" width="100" >
                                            <h4 style="Text-align: justify;" align="justify">{{$product->slug}}</h4>  
                                            <h4>Precio  {{number_format($product->price)}}</h4>                                  
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>                    
        </div>
    </div>
</div>
{{$products->links()}}
@endsection
