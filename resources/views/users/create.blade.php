@extends('layouts.app')
@section('content')

<!--<div class="row justify-content-center">
    <div class="col-md-4">
        @include('users.fragment.error')
    </div>
</div>-->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear usuario</div>

                <div class="card-body">
                    <form action="{{route('users.store')}}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label name="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input type="text" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="role" class="col-md-4 col-form-label text-md-right">Role</label>
                            <div class="col-md-6">
                            <select class="form-control" name="role">
                            <option value="">Ninguno</option>
                            @foreach($roles as $key => $value)
                                <option value=" {{ $value }} "> {{$value}} </option>
                            @endforeach
                            </select>
                            </div>
                            <!--<div class="col-md-6">
                                <input type="text" name="role" class="form-control">
                            </div>-->
                        </div>
                        <div class="form-group"><P ALIGN=center>
                        </div>
                        <button class="btn btn-success" type="submit" >Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection