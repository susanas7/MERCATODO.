@extends('layouts.app')
@section('content')

<div class="container" >
    <div class="row justify-content-center" >
        <div class="col-md-10">
            <div class="card" id="box-crud" >
                <div class="card-header"><P ALIGN=center> {{ $orders->total() }} ordenes | página {{ $orders->currentPage() }} de {{ $orders->lastpage() }} </div>
                  <div class="card-body">
                    <table class="table">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>&nbsp;</th>
                        <th>Producto</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Categoria</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                      </tr>
                      </thead>
                        @foreach ($orders as $order)
                        <tr>
                          <td>{{ $order->id }}</td>
                          <td>{{ $order->user->name }}</td>
                          <td>{{$product->slug}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{$orders->links()}}
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection