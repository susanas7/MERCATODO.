@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Usuario: {{$user->name}}</div>

                <div class="card-body">
                        <div class="form-group row">
                            <label name="name" class="col-md-4 col-form-label text-md-right">Nombre:</label>

                            <div class="col-md-6">
                            <label name="name" class="col-md-8 col-form-label text-md-center">{{$user->name}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">Email:</label>

                            <div class="col-md-6">
                            <label name="name" class="col-md-8 col-form-label text-md-center">{{$user->email}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="role" class="col-md-4 col-form-label text-md-right">Role:</label>

                            <div class="col-md-6">
                                <label name="name" class="col-md-8 col-form-label text-md-center">{{ $user->roles->implode('name', ',')}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="status" class="col-md-4 col-form-label text-md-right">Estado:</label>

                            <div class="col-md-6">
                                <label name="name" class="col-md-8 col-form-label text-md-center">
                                @if($user->is_active==1)
                                    Activo
                                @else
                                    Inactivo
                                @endif
                                </label>
                            </div>
                        </div>
                        @if($user->data)
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">Nro de documento:</label>

                            <div class="col-md-6">
                            <label name="name" class="col-md-8 col-form-label text-md-center">{{$user->data->document_type}} - {{$user->data->document}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">Dirección:</label>

                            <div class="col-md-6">
                            <label name="name" class="col-md-8 col-form-label text-md-center">{{$user->data->address}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">Celular:</label>

                            <div class="col-md-6">
                            <label name="name" class="col-md-8 col-form-label text-md-center">{{$user->data->phone}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">Fecha de nacimiento:</label>

                            <div class="col-md-6">
                            <label name="name" class="col-md-8 col-form-label text-md-center">{{$user->data->birthday}}</label>
                            </div>
                        </div>
                        @endif
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">Se unió:</label>

                            <div class="col-md-6">
                            <label name="name" class="col-md-8 col-form-label text-md-center">{{$user->created_at}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">Email verificado:</label>

                            <div class="col-md-6">
                            <label name="name" class="col-md-8 col-form-label text-md-center">{{$user->email_verified_at}}</label>
                            </div>
                        </div>
                        <div class="form-group"><P ALIGN=center>
                        </div>
                        <a href="{{route ('users.index')}}">Regresar</a>
                        <a href="{{route ('users.edit', $user->id)}}">Editar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
