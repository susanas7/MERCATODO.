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
                    <?php $img = $product['item']['img_route'] ?>
                    <img src="{{url("storage/$img")}}">
                    {{$product['item']['title']}}<br>
                    <?php $pU = $product['price']/$product['qty'] ?>
                    $ {{number_format($pU, 2)}}
                </div>
                <div class="shoppingcart-quantity">
                    {{$product['qty']}}
                </div>
                <div class="shoppingcart-subtotal">
                    {{number_format($product['price'], 2)}}
                    
                        <a class="btn btn-link" href="{{route('user.removeItem', ['id' => $product['item']['id']])}}">
                            x
                        </a>
                        <a class="btn btn-link" href="{{route('user.addByOne', ['id' => $product['item']['id']])}}">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
                            </svg>
                        </a>
                        <a class="btn btn-link" href="{{route('user.reduceByOne', ['id' => $product['item']['id']])}}"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3.5 8a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                        </a>
                    
                </div>
            </div>
        @endforeach
    </div>
    <div class="shoppingcart-footer">
        <div class="shoppingcart-total">
            Total:
        </div>
        <div class="shoppingcart-totalprice">
            {{ number_format($totalPrice, 2) }}
        </div>
    </div>
</section>

@endif
@endsection