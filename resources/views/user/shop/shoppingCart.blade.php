@extends('layouts.app')
@section('content')

@if(Session::has('cart'))

<section class="container-shoppingcart">
    <div class="shoppingcart-header">
        <div class="shoppingcart-items">
            Productos
        </div>
        <div class="shoppingcart-quantities">
            Cantidad
        </div>
        <div class="shoppingcart-subtotals">
            Subtotal
        </div>
    </div>
    <div class="shoppingcart-content">
        @foreach($products as $product)
            <div class="shoppingcart-content-container">
                <div class="shoppingcart-item">
                    {{$product['item']['title']}}<br>
                    
                    <a class="btn btn-link" href="{{route('user.removeItem', ['id' => $product['item']['id']])}}">
                        Remove
                    </a>
                </div>
                <div class="shoppingcart-quantity">
                    {{$product['qty']}}
                </div>
                <div class="shoppingcart-subtotal">
                    {{$product['price']}}
                </div>
            </div>
        @endforeach
    </div>
    <div class="shoppingcart-footer">
        hh
    </div>
</section>

@endif
@endsection