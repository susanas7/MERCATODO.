@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" >
            <div class="card"  id="box-crud">
                <div class="card-header"><P ALIGN=center> {{ $categories->total() }} usuarios | página {{ $categories->currentPage() }} de {{ $categories->lastpage() }}</div>
                  <div class="card-body">
                    <div>
                    @can('crear usuario')
                      <a href="{{route('categories.create')}}" class="btn btn-primary">Crear</a>
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
                              <a class="btn btn-link" id="edit-crud" href="{{route('categories.edit', $category->id)}}">Editar</a>
                          </td>
                          <td>
                            @can('eliminar categoria')
                              <form action="{{ route('categories.destroy', $category) }}" method="POST">
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
