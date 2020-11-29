@extends('layouts.app')

@section('content')

@if(Session::has('cart'))
    <div class="row">
        <div class="container">
            <ul id="cart0" class="list-group">
                @foreach($products as $product)
                    <li id="cart1" class="list-group-item">
                        <a class="btn btn-link" href="{{route('user.removeItem', ['id' => $product['item']['id']])}}">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                            <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                            </svg>
                        </a>
                        <span class="badge">{{$product['qty']}}</span>
                        <td>&nbsp;</td>
                        <td><br><img src="{{ $product->get_image ?? '' }}" class="card-img-top"></td>
                        <strong>{{$product['item']['title']}}</strong>
                        <span class="label label-success">{{$product['price']}}</span>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <a class="btn btn-link" href="{{route('user.reduceByOne', ['id' => $product['item']['id']])}}"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3.5 8a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                        </a>
                        <a class="btn btn-link" href="{{route('user.addByOne', ['id' => $product['item']['id']])}}">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
                            </svg>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="container">
            <div id="cart2">
                <strong>Total: {{ number_format($totalPrice, 2) }}</strong> 
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="container">
        <form id="cc" action="{{route('user.store.order')}}" method="POST">
        {{ csrf_field() }}

            <button id="confirm" type="submit">Confirmar</button>
        </form>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <strong>Total: {{ $totalPrice ?? '' }}</strong> 
        </div>
    </div>

@endif


@endsection