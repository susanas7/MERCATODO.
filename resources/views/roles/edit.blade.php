@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar rol</div>

                <div class="card-body">
                    <form action="{{route('roles.update', $role)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label name="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" value="{{$role->name}}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="slug" class="col-md-4 col-form-label text-md-right">Descripcion</label>

                            <div class="col-md-6">
                                <input type="text" name="slug" class="form-control" value="{{$role->slug}}" >
                            </div>
                        </div>
                        <h3>Permisos</h3>
                        <div class="form-group">
                            <ul class="list-unstyled">
                                @foreach($permissions as $permission)
                                <li>
                                    <label>
                                    <div class="form-check">
                                        <label class="form-check-label" for="permissions[{{ $permission->id }}]">
                                        <input type="checkbox" value="{{ $permission->id }}"
                                        name="permissions[]" id="permissions[{{ $permission->id }}]"
                                        class="form-check-input"
                                         @if(isset($assignedPermissions)){{in_array($permission->id,$assignedPermissions) ? 'checked':''}}@endif
                                         >{{ $permission->name }}
                                        </label>
                                    </div>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="form-group"><P ALIGN=center>
                        </div>
                        <button class="btn btn-success" type="submit" >Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection