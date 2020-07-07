@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                  <div class="card-body">
                       
                    <table class="table">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Categoria</th>
                        <th>Eliminar</th>
                      </tr>
                      </thead>
                        @foreach ($products as $product)
                        <tr>
                          <td>{{ $product->id }}</td>
                          <td>{{ $product->title }}</td>
                          <td>{{ $product->price }}</td>
                          <td>{{ $product->category_id }}</td>
                          <td>
                            <form action="{{ route('products.destroy', $product) }}" method="POST">
                              @method('DELETE')
                              @csrf
                              <input type="submit"
                              value="Eliminar"
                              onclick="return confirm('¿Desea eliminar?')">
                            </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
            </div>
        </div>
    </div>
</div>

{{$products->links()}}

@endsection