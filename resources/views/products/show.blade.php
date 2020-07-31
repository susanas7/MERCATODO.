@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Ver producto</strong>
                </div>
                <div class="panel-body">
                    <p><img src="{{ $product->get_image }}" class="card-img-top" width="100px" ></p>
                    <p><strong>Nombre:  </strong> {{$product->title}} </p>
                    <p><strong>Descripcion:  </strong>{{$product->slug}} </p>
                    <p><strong>Precio:  </strong>{{$product->price}} </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection