@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card" id="box-search-crud">
        <div class="card-body">
        <form action=" {{route('admin.categories.index')}} ">
          <div class="row">
            <div class="col" >
              <input type="text" name="title" class="form-control form-control-navbar" value="{{old('title' , request('title'))}}">
            </div>
            <div class="col">
            <button type="submit" id="btn-search-crud" class="btn btn-link">Buscar</button>
            <a href="{{ route('admin.categories.index') }}" id="btn-refresh-crud" class="btn btn-link">Regresar</a>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div><br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" >
            <div class="card"  id="box-crud">
                  <div class="card-body">
                  <div class="card-header"><P ALIGN=center> {{ $categories->total() }} categorias | página {{ $categories->currentPage() }} de {{ $categories->lastpage() }}</div>

                    <div>
                    @can('crear categoria')
                      <a href="{{route('admin.categories.create')}}" class="btn btn-primary">Crear</a>
                    @endcan
                    </div><br>
                    <table class="table">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Categoría</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                      </tr>
                      </thead>
                        @foreach ($categories as $category)
                        <tr>
                          <td>{{ $category->id }}</td>
                          <td>{{ $category->title }}</td>
                          <td></td>
                          <td>
                              <a class="btn btn-link" id="edit-crud" href="{{route('admin.categories.edit', $category->id)}}">Editar</a>
                          </td>
                          <td>
                            @can('eliminar categoria')
                              <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
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
                    {{$categories->links()}}
                  </div>
            </div>
        </div>
    </div>
</div>

@endsection
