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
                <div class="card-header">Editar usuario</div>

                <div class="card-body">
                    <form action="{{route('admin.users.update', $user)}}" method="POST">
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
                        <button class="btn btn-success" type="submit" >Editar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
