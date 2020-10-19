@extends('layouts.app')
@section('content')

@if($order->invoice)
    <a href="{{route('invoices.show' , $order->id)}}">ver factura</a>
@else
    <form action="{{route('invoices.store', $order->id)}}">
        @csrf
        <button type="submit"> generar factura </button>
    </form>
@endif


@endsection