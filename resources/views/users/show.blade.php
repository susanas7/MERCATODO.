@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Ver usuario</strong>
                </div>
                <div class="panel-body">
                    <p><strong>Nombre:  </strong> {{$user->name}} </p>
                    <p><strong>Email:  </strong>{{$user->email}} </p>
                    <p><strong>Email verificado:  </strong>{{$user->email_verified_at}} </p>
                    <p><strong>Rol:  </strong>{{$user->role}} </p>
                    <p><strong>Estado:  </strong>{{$user->status}} </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection