@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><P ALIGN=center> {{ $products->total() }} productos | página {{ $products->currentPage() }} de {{ $products->lastpage() }} </div>
                  <div class="card-body">
                    <div>
                      <a href="{{route('products.create')}}" class="btn btn-primary">Crear</a>
                    </div><br>
                    <table class="table">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Categoria</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                      </tr>
                      </thead>
                        @foreach ($products as $product)
                        <tr>
                          <td>{{ $product->id }}</td>
                          <td><img src="{{ URL::to('/images/' . $product->img_route) }}" width="100"> </td>
                          <td>{{ $product->title }}</td>
                          <td>{{ $product->price }}</td>
                          <td>{{ $product->category_id }}</td>
                          <td>
                            <!--<a href="{{route('products.show', $product->id) }}" class="btn btn-sm btn-default">Ver</a>-->
                            <a class="btn btn-success" data-toggle="modal" data-target="#{{$product->title}}" >Ver</a>
                              <!-- ventana emergente-->
                              <div class="modal fade" id="{{$product->title}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">{{$product->title}}</h4>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                        </div>
                                        <div class="modal-body">
                                            <div align="center">
                                            <img src="{{ URL::to('/images/' . $product->img_route) }}" width="250">
                                            </div>
                                            <div><P ALIGN=center>
                                              <p><h4>{{$product->slug}}</h4></p> 
                                              <p><h4>Precio: $ {{$product->price}} </h4></p>
                                              <p><h4>Categoria: {{$product->category_id}} </h4></p> 
                                              <p><h4>Estado: {{$product->status}} </h4></p>
                                              <p><h4>Fecha de creacion: {{$product->created_at}}</h4></p>  
                                              <p><h4>Ultima actualizacion: {{$product->updated_at}} </h4></p>
                                            </div>    
                                        </div>
                                        <div class="modal-footer">
                                        <a class="btn btn-info" href="{{route('products.edit', $product->id)}}" >Editar</a>                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </td>
                          <td>
                              <a class="btn btn-info" href="{{route('products.edit', $product->id)}}" >Editar</a>
                          </td>
                          <td>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" >
                              @method('DELETE')
                              @csrf
                              <input type="submit"
                              value="Eliminar"
                              class="btn btn-danger"
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