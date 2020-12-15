@extends('layouts.app')
@section('content')

<section class="order-show-container">
    <div class="order-info-container">
        <div class="order-ref">
            <p>Referencia</p>
            <p>Comprador</p>
            <p>Fecha</p>
            <p>Estado</p>
            <p>&nbsp;</p>
            <p>
            </p>
            
        </div>
        <div class="order-info">
            <p>{{$order->id}}</p>
            <p>{{$order->user->name ?? ''}}</p>
            <p>{{$order->created_at}}</p>
            <p>{{$order->status}}</p>
            <p>&nbsp;</p>
            @foreach($order->products as $product)
                <p>{{$product->title}}</p>
            @endforeach
            <p>&nbsp;</p>
            <p>{{$order->total}}</p>
        </div>
    </div>
</section><br>
<div class="order-payment-container">
@if(auth()->user()->id == $order->user_id)
    @if($order->status == 'APPROVED')
        <a href="{{$order->processUrl}}">Ver transacción</a>
    @else
    <h3>Pagar</h3>
        <a href="{{'/user/checkout/'.$order->id}}">
            <img src="https://static.placetopay.com/placetopay-logo.svg" class="attachment-0x0 size-0x0" alt="" loading="lazy">
        </a>
    @endif
@endif
</div>
@endsection