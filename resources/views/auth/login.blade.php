@extends('layouts.app')

@section('content')

<div class="center">
    <h1>Login</h1>
    <form method="POST" action="{{route('login')}}">
        @csrf 
        <div class="txt_field">
            <input type="text" name="email">
            <span></span>
            <label>Email</label>
        </div>
        <div class="txt_field">
            <input type="password" name="password">
            <span></span>
            <label>Password</label>
        </div>
        <div>
        @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
            <input type="submit" value="Login">
        </div>
    </form>
</div>

@endsection
