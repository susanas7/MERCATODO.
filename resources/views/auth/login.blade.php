@extends('layouts.app')

@section('content')

<div class="center">
    <h1>Login</h1>
    <form method="POST" action="{{route('login')}}">
        @csrf 
        <div class="txt_field">
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror">
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
            <label>Password</label>
        </div>
        <div>
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
        <br>
            <input type="submit" value="Ingresar">
        </div>
    </form>
</div>

@endsection
