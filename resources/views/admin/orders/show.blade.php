@extends('layouts.app')
@section('content')

<section class="order-show-container">
    <div class="order-info-container">
        <div class="order-ref">
            <p>Referencia</p>
            <p>Comprador</p>
            <p>&nbsp;</p>
            <p>
            @foreach($order->products as $product)
                <p>{{$product->title}}</p>
            @endforeach
            </p>
            
        </div>
        <div class="order-info">
            <p>{{$order->id}}</p>
            <p>{{$order->user->name ?? ''}}</p>
            <p>&nbsp;</p>
            @foreach($order->products as $product)
                {{$orderProduct->quantity}}
            @endforeach
        </div>
    </div>
</section>

@endsection

<!--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Orden: {{$order->id}}</div>

                <div class="card-body">
                        <div class="form-group row">
                            <label name="name" class="col-md-4 col-form-label text-md-right">Comprador:</label>

                            <div class="col-md-6">
                            <label name="name" class="col-md-8 col-form-label text-md-center">{{$order->user->name ?? ''}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="role" class="col-md-4 col-form-label text-md-right">Cantidad:</label>

                            <div class="col-md-6">
                                <label name="name" class="col-md-8 col-form-label text-md-center">{{$order->quantity}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="role" class="col-md-4 col-form-label text-md-right">Estado:</label>

                            <div class="col-md-6">
                                <label name="name" class="col-md-8 col-form-label text-md-center">{{$order->status}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="status" class="col-md-4 col-form-label text-md-right">Total a pagar:</label>

                            <div class="col-md-6">
                                <label name="name" class="col-md-8 col-form-label text-md-center">{{$order->total}}</label>
                            </div>
                        </div>
                        <div class="form-group"><P ALIGN=center>
                        </div>
                        @if(auth()->user()->id == $order->user_id)
                            @if($order->status == 'APPROVED')
                                <a href="{{$order->processUrl}}">Ver transacción</a>
                            @else
                                <a href="{{'/user/checkout/'.$order->id}}">Pagar</a>
                            @endif
                        @endif
                        <div class="form-group row">
                            <label name="status" class="col-md-4 col-form-label text-md-right">products</label>
                            
                            <div class="col-md-6">
                            @foreach($order->products as $product)
                                <label name="name" class="col-md-8 col-form-label text-md-center">{{$product->title}} {{$product->price}}</label>
                                @endforeach
                            </div>
                            
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

-->