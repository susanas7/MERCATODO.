@extends('layouts.app')

@section('content')

<div class="container" >
    <div class="row justify-content-center" >
        <div class="col-md-10"  id="box-crud" >
            <div class="card" >
                <div class="card-header" ><P ALIGN=center> {{ $roles->total() }} roles | página {{ $roles->currentPage() }} de {{ $roles->lastpage() }}</div>
                  <div class="card-body">
                  <a href="{{route('roles.create')}}" class="btn btn-primary">Crear</a>
                    <br>
                    <table class="table">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>&nbsp;</th>
                      </tr>
                      </thead>
                        @foreach ($roles as $role)
                        <tr>
                          <td>{{ $role->id }}</td>
                          <td>{{ $role->name }}</td>
                          <td>{{ $role->slug }}</td>
                          <td>
                          <a id="show-crud" class="btn btn-link" href="{{route('roles.show', $role)}}">Ver</a>
                          </td>
                          <td>
                              <a class="btn btn-link" id="edit-crud" href="{{route('roles.edit', $role)}}">Editar</a>
                          </td>
                          <td>
                            <form action="{{ route('roles.destroy', $role) }}" method="POST" >
                                @method('DELETE')
                                @csrf
                                <input type="submit"
                                value="Eliminar"
                                class="btn btn-link"
                                id="delete-crud"
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
{{$roles->links()}}
@endsection