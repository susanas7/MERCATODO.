@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-4">
        @include('users.fragment.error')
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar usuario</div>

                <div class="card-body">
                    <form action="{{route('users.update', $user)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label name="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" value="{{$user->name}}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input type="text" name="email" class="form-control" value="{{$user->email}}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="document" class="col-md-4 col-form-label text-md-right">Nro de documento</label>

                            <div class="col-md-6">
                                <input type="text" name="document" class="form-control" value="{{$user->data->document}}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">Dirección</label>

                            <div class="col-md-6">
                                <input type="text" name="email" class="form-control" value="{{$user->data->address}}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">Celular</label>

                            <div class="col-md-6">
                                <input type="text" name="email" class="form-control" value="{{$user->data->phone}}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">Fecha de nacimiento</label>

                            <div class="col-md-6">
                                <input type="text" name="email" class="form-control" value="{{$user->data->birthday}}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="role" class="col-md-4 col-form-label text-md-right">Role</label>

                            <div class="col-md-6">
                            <select class="form-control" name="role">
                            @foreach($roles as $key => $value)
                                @if($user->hasRole($value))
                                <option value=" {{ $value }} " selected> {{$value}} </option>
                                @else
                                <option value="{{ $value }}">{{ $value }}</option>
                                @endif
                            @endforeach
                            <option value="">Ninguno</option>
                            </select>
                            </div>
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
