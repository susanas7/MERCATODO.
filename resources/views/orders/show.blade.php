@extends('layouts.app')
@section('content')


{{$order->id}}<br>
{{$order->user->name}}<br>
{{$order->status}}<br>
{{$order->quantity}}<br>
{{$order->total}}<br>


<a href="#">PAGAR</a>


@endsection