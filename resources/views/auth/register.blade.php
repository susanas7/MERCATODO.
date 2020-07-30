@extends('layouts.app')

@section('content')

<div class="center">
    <h1>Login</h1>
    <form method="POST" action="{{route('register')}}">
        @csrf 
        <div class="txt_field">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span></span>
            <label>Nombre</label>
        </div>
        <div class="txt_field">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span></span>
            <label>Email</label>
        </div>
        <div class="txt_field">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span></span>
            <label>Contraseña</label>
        </div>
        <div class="txt_field">
            <input type="password" name="password_confirmation">
            <span></span>
            <label>Confirmar contraseña</label>
        </div>
        <div>
            <input type="submit" value="Registrarse">
        </div>
    </form>
</div>

@endsection
