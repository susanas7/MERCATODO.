@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Orden: {{$order->id}}</div>

                <div class="card-body">
                        <div class="form-group row">
                            <label name="name" class="col-md-4 col-form-label text-md-right">Comprador:</label>

                            <div class="col-md-6">
                            <label name="name" class="col-md-8 col-form-label text-md-center">{{$order->user->name}}</label>
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
                            <a href="{{$order->processUrl}}">Ver pago</a>
                            @else
                            <a href="{{route('user.checkout',$order->id)}}">Pagar</a>
                            @endif
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection