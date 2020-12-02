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
                        @if($user->can('api'))
                        @if($user->id == auth()->user()->id)
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">API TOKEN:</label>

                            <div class="col-md-6">
                            <label name="name" class="col-md-8 col-form-label text-md-center">{{$user->api_token}}</label>
                            <a href="{{route ('user.newApiToken')}}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                </svg>
                            </a>
                            <a href="{{route ('user.deleteApiToken')}}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                </svg>
                            </a>
                            </div>
                        </div>
                        @endif
                        @endif
                        <div class="form-group"><P ALIGN=center>
                        </div>
                        <a href="{{route ('admin.users.index')}}">Regresar</a>
                        @if($user->id == auth()->user()->id)
                            <a href="{{route ('user.editMyProfile')}}">Editar mi perfil</a>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
