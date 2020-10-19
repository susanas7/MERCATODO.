@extends('layouts.app')

@section('content')

<div class="box">
    <h1>Verifica tu email</h1>
    @if (session('resent'))
        <div id="alert" class="alert alert-success" role="alert">
            {{ __('Se ha enviado un nuevo enlace de verificación a su correo electrónico.') }}
        </div>
    @endif
    <h4>
    Antes de continuar, revise su correo electrónico para obtener un enlace de verificación. Si no recibió el correo electrónico:
    </h4>
    <form method="POST" action="{{route('verification.resend')}}">
        @csrf 
        <button id="box-btn" type="submit">haz click aqui para solicitar otro</button>
    </form>
</div>


@endsection

<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>-->
