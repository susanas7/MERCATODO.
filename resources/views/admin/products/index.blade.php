@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card" id="box-search-crud">
        <div class="card-body">
        <form action=" {{route('admin.products.index')}} ">
          <div class="row">
            <div class="col" >
              <input type="text" name="title" class="form-control form-control-navbar" value="{{old('title' , request('title'))}}">
            </div>
            <div class="col">
            <button type="submit" id="btn-search-crud" class="btn btn-link">Buscar</button>
            <a href="{{ route('admin.products.index') }}" id="btn-refresh-crud" class="btn btn-link">Regresar</a>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div><br>

<div class="container" >
    <div class="row justify-content-center" >
        <div class="col-md-10">
            <div class="card" id="box-crud" >
                <div class="card-header"><P ALIGN=center> {{ $products->total() }} productos | página {{ $products->currentPage() }} de {{ $products->lastpage() }} </div>
                  <div class="card-body">
                    <div>
                      <a href="{{route('admin.products.create')}}" class="btn btn-primary">Crear</a>
                      <form action="{{route('admin.products.export')}}">
                        <select name="category_id" id="category_id">
                          <option value="">--</option>
                          @foreach($categories as $category)
                            <option value="{{$category->id}}"> {{$category->title}} </option>
                          @endforeach
                        </select>
                        <select name="is_active" id="is_active">
                            <option value="">--</option>
                            <option value="0"> Inactivo </option>
                            <option value="1"> Activo </option>
                        </select>
                        
                        <button type="submit">Exportar</button>

                      </form>
                      
                      @isset($errors)
                      <div class="row justify-content-center">
                          <div class="col-md-8">
                              @include('fragment.errors')
                          </div>
                      </div>
                      @endisset
                      <form action="{{route('admin.products.import')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file">
                        <button typ="submit" class="btn btn-link">Importar</button>
                      </form>
                    </div><br>
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
                        @foreach ($products as $product)
                        <tr>
                          <td>{{ $product->id }}</td>
                          <td><img src="{{ $product->get_image }}" class="card-img-top"> </td>
                          <td>{{ $product->title }}</td>
                          <td>{{$product->slug}}</td>
                          <td>{{ number_format($product->price, 2) }}</td>
                          <td>
                          @if($product->is_active==1)
                              Activo
                            @else
                              Inactivo
                            @endif
                          </td>
                          <td> {{$product->category->title ?? ''}} </td>
                          <td></td>
                          <td>
                          @can('ver producto')
                            <a href="{{route('admin.products.show', $product->id) }}" id="show-crud" class="btn btn-link">Ver</a>
                          @endcan
                          </td>
                          <td>
                          @if($product->is_active==1)
                            <a href="{{route('admin.products.changeStatus', $product->id)}}" id="status-crud" class="btn btn-link"
                            >Desactivar</a>
                          @else
                            <a href="{{route('admin.products.changeStatus', $product->id)}}" id="status-crud" class="btn btn-link" 
                            >Activar</a>
                          @endif
                          </td>
                          <td>
                            @can('editar producto')
                              <a class="btn btn-link" id="edit-crud" href="{{route('admin.products.edit', $product->id)}}" >Editar</a>
                            @endcan
                          </td>
                          <td>
                            @can('eliminar producto')
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" >
                              @method('DELETE')
                              @csrf
                              <input type="submit"
                              value="Eliminar"
                              class="btn btn-link"
                              id="delete-crud"
                              onclick="return confirm('¿Desea eliminar?')">
                            </form>
                            @endcan
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{$products->links()}}
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection