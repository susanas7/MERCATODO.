@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header"> Bienvenido</div>
                <div class="card-header"><P ALIGN=center> {{ $users->total() }} usuarios | página {{ $users->currentPage() }} de {{ $users->lastpage() }}</div>
                  <div class="card-body">
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
                          <td>{{ $user->role}}</td>
                          <td>
                            <!--<a href="{{route('users.show', $user->id) }}" class="btn btn-sm btn-default">Ver</a>-->
                            <a class="btn btn-success" data-toggle="modal" data-target="#{{$user->name}}" >Ver</a>
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
                                              <p><h4>Rol: {{$user->role}} </h4></p> 
                                              <p><h4>Estado: {{$user->status}} </h4></p>
                                              <p><h4>Fecha de creacion: {{$user->created_at}}</h4></p>  
                                              <p><h4>Ultima actualizacion: {{$user->updated_at}} </h4></p>
                                            </div>    
                                        </div>
                                        <div class="modal-footer">
                                        <a class="btn btn-info" href="{{route('users.edit', $user->id)}}" >Editar</a>                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </td>
                          <td>
                              <a class="btn btn-info" href="{{route('users.edit', $user->id)}}">Editar</a>
                          </td>
                          <td>
                            <form action="{{ route('users.destroy', $user) }}" method="POST">
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
{{$users->links()}}
@endsection
