@extends('layouts.app')

@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card" id="box-search-crud">
        <div class="card-body">
        <form action=" {{route('users.index')}} ">
          <div class="row">
            <div class="col" >
              <input type="text" name="name" class="form-control form-control-navbar" value="{{old('name' , request('name'))}}">
            </div>
            <div class="col">
            <button type="submit" id="btn-search-crud" class="btn btn-link">Buscar</button>
            <a href="{{ route('users.index') }}" id="btn-refresh-crud" class="btn btn-link">Regresar</a>
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
                <div class="card-header"><P ALIGN=center> {{ $users->total() }} usuarios | página {{ $users->currentPage() }} de {{ $users->lastpage() }}</div>
                  <div class="card-body">
                    <div>
                    @can('crear usuario')
                      <a href="{{route('users.create')}}" class="btn btn-primary">Crear</a>
                    @endcan
                    </div><br>
                    <table class="table">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th>Rol</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                      </tr>
                      </thead>
                        @foreach ($users as $user)
                        <tr>
                          <td>{{ $user->id }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>
                            @if($user->is_active==1)
                              Activo
                            @else
                              Inactivo
                            @endif
                          </td>
                          <td>{{ $user->roles->implode('name', ',')}}</td>
                          <td>
                          @can('ver usuario')
                            <a href="{{route('users.show', $user->id) }}" id="show-crud" class="btn btn-link">Ver</a>
                          @endcan
                          </td>
                          <td>
                          @if($user->is_active==1)
                            <a href="{{route('users.changeStatus', $user->id)}}" id="status-crud" class="btn btn-link">Desactivar</a>
                          @else
                            <a href="{{route('users.changeStatus', $user->id)}}" id="status-crud" class="btn btn-link" >Activar</a>
                          @endif
                          </td>
                          <td>
                              <a class="btn btn-link" id="edit-crud" href="{{route('users.edit', $user->id)}}">Editar</a>
                          </td>
                          <td>
                            @can('eliminar usuario')
                              <form action="{{ route('users.destroy', $user) }}" method="POST">
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
                    {{$users->links()}}
                  </div>
            </div>
        </div>
    </div>
</div>

@endsection