@extends('layouts.app')

@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
        <h6>Busqueda de usuarios</h6>
        <form action=" {{route('users.index')}} ">
          <div class="row">
            <div class="col" >
              <input type="text" name="name" class="form-control form-control-navbar" placeholder="Nombre">
            </div>
            <div class="col" >
              <input type="text" name="email" class="form-control form-control-navbar" placeholder="Email">
            </div>
            <div class="col">
            <button type="submit" class="btn btn-default">Buscar</button>
            <a href="{{ route('users.index') }}" class="btn btn-link">Regresar</a>
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
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><P ALIGN=center> {{ $users->total() }} usuarios | página {{ $users->currentPage() }} de {{ $users->lastpage() }}</div>
                  <div class="card-body">
                    <div>
                    @can('create user')
                      <a href="{{route('users.create')}}" class="btn btn-primary">Crear</a>
                    @endcan
                    </div><br>
                    <table class="table">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
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
                          <td>{{ $user->roles->implode('name', ',')}}</td>
                          <td>
                            <!--<a href="{{route('users.show', $user->id) }}" class="btn btn-sm btn-default">Ver</a>-->
                            @can('read user')
                              <a class="btn btn-success" data-toggle="modal" data-target="#{{$user->name}}" >Ver</a>
                            @endcan
                              <!-- ventana emergente-->
                              <div class="modal fade" id="{{$user->name}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="muModalLabel">Usuario</h4>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                        </div>
                                        <div class="modal-body">
                                            <div><P ALIGN=center>
                                              <p><h4>Nombre: {{$user->name}}</h4></p> 
                                              <p><h4>Email: {{$user->email}} </h4></p>
                                              <p><h4>Rol: {{ $user->roles->implode('name', ',') }} </h4></p> 
                                              <p><h4>Estado: {{$user->status}} </h4></p>
                                              <p><h4>Email verificado: {{$user->email_verified_at}} </h4></p>
                                              <p><h4>Fecha de creacion: {{$user->created_at}}</h4></p>  
                                              <p><h4>Ultima actualizacion: {{$user->updated_at}} </h4></p>
                                            </div>    
                                        </div>
                                        <div class="modal-footer">
                                        @can('edit users')
                                          <a class="btn btn-info" href="{{route('users.edit', $user->id)}}" >Editar</a>
                                        @endcan                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </td>
                          <td>
                              <a class="btn btn-info" href="{{route('users.edit', $user->id)}}">Editar</a>
                          </td>
                          <td>
                            @can('delete user')
                              <form action="{{ route('users.destroy', $user) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit"
                                value="Eliminar"
                                class="btn btn-danger"
                                onclick="return confirm('¿Desea eliminar?')">
                              </form>
                            @endcan
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
{{$users->links()}}
@endsection
