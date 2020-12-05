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
                        <th>Comprador</th>
                        <th>Estado</th>
                        <th>Total</th>
                        <th>Fecha de creacion</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                      </tr>
                      </thead>
                        @foreach ($orders as $order)
                        <tr>
                          <td>{{ $order->id }}</td>
                          <td>{{ $order->user->name }}</td>
                          <td>{{ $order->status }}</td>
                          <td>{{ $order->total }}</td>
                          <td>{{ $order->created_at }}</td>
                          <td>
                            <a href="{{route('admin.orders.show', $order->id) }}" id="show-crud" class="btn btn-link">Ver</a>
                          </td>
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