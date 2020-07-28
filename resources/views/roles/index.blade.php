@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><P ALIGN=center> {{ $roles->total() }} roles | página {{ $roles->currentPage() }} de {{ $roles->lastpage() }}</div>
                  <div class="card-body">
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
                          <a href="{{route('roles.show', $role->id)}}">Ver</a>
                            <!--
                            @can('ver rol')
                            <a class="btn btn-success" data-toggle="modal" data-target="#{{$role->name}}" >Ver</a>
                            @endcan
                            ventana emergente
                            <div class="modal fade" id="{{$role->name}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="muModalLabel">Rol: {{$role->name}}</h4>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                        </div>
                                        <div class="modal-body">
                                            <div><P ALIGN=center>
                                              <p><h4>Nombre: {{$role->name}}</h4></p> 
                                              <p><h4>Descripcion: {{$role->slug}} </h4></p>
                                              <p><h4>Permisos:
                                              <h4> {{ $role->permissions->implode('name' , ', ')}} </h4>
                                              <p><h4>Fecha de creacion: {{$role->created_at}}</h4></p>  
                                              <p><h4>Ultima actualizacion: {{$role->updated_at}} </h4></p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                          @can('editar rol')
                                          <a class="btn btn-info" href="{{route('roles.edit', $role->id)}}" >Editar</a>
                                          @endcan                                          
                                        </div>
                                        </div>
                                </div>
                            </div>-->
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