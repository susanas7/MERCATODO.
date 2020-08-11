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
    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <strong>Total: {{$totalPrice}}</strong> 
        </div>
    </div>

@endif


@endsection