@extends('layouts.app')

@section('content')

@if(Session::has('cart'))
    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <ul class="list-group">
                @foreach($products as $product)
                    <li class="list-group-item">
                        <span class="badge">{{$product['qty']}}</span>
                        <strong>{{$product['item']['title']}}</strong>
                        <span class="label label-success">{{$product['price']}}</span>
                        <a class="btn btn-link" href="{{route('reduceByOne', ['id' => $product['item']['id']])}}">Eliminar 1</a>
                        <a class="btn btn-link" href="{{route('addByOne', ['id' => $product['item']['id']])}}">Add 1</a>
                        <a class="btn btn-link" href="{{route('removeItem', ['id' => $product['item']['id']])}}">Remove</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <strong>Total: {{$totalPrice}}</strong> 
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <button type="button" class="btn btn-success">Checkout</button> 
        </div>
    </div>
@else
    <div class="row">incremento	Retorna $a, y luego incrementa $a en uno.
--$a	Pre-decremento	Decrem
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <strong>Total: {{ $totalPrice ?? '' }}</strong> 
        </div>
    </div>

@endif


@endsection