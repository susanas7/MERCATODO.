@extends('layouts.app')
@section('content')

@if(Session::has('cart'))

<section class="container-shoppingcart">
    <div class="shoppingcart-header">
        <div class="shoppingcart-items">
            Productos
        </div>
        <div class="shoppingcart-quantity">
            Cantidad
        </div>
        <div class="shoppingcart-subtotal">
            Subtotal
        </div>
    </div>
    <div class="shoppingcart-content">
        hh
    </div>
    <div class="shoppingcart-footer">

    </div>
</section>

@endif
@endsection