@extends('layouts.app')
@section('content')

@isset($errors)
<div class="row justify-content-center">
    <div class="col-md-4">
        @include('fragment.errors')
    </div>
</div>
@endisset

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar rol</div>

                <div class="card-body">
                    <form action="{{route('admin.roles.update', $role)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label name="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" value="{{$role->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">Descripcion</label>

                            <div class="col-md-6">
                                <input type="text" name="slug" class="form-control" value="{{$role->slug}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="password" class="col-m d-4 col-form-label text-md-right">Permisos</label>

                            <div class="col-md-6">
                            @foreach($permissions as $p)
                                @if($role->hasPermissionTo($p))
                                    <input type="checkbox" name="permissions[]" value=" {{ $p->id }} " checked> {{$p->name}} </br>
                                @else
                                <input type="checkbox" name="permissions[]" value="{{$p->id}}"> {{$p->name}}<br>
                                @endif
                            @endforeach
                            </div>
                        </div>
                        <button class="btn btn-success" type="submit" >Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection