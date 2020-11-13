@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categoria: {{$category->title}}</div>

                <div class="card-body">
                        <div class="form-group row">
                            <label name="name" class="col-md-4 col-form-label text-md-right">Nombre:</label>

                            <div class="col-md-6">
                            <label name="name" class="col-md-8 col-form-label text-md-right">{{$category->title}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">Fecha de creacion:</label>

                            <div class="col-md-6">
                            <label name="name" class="col-md-8 col-form-label text-md-right">{{$category->created_at}}</label>
                            </div>
                        </div>
                        <div class="form-group"><P ALIGN=center>
                        </div>
                        <a href="{{route ('users.index')}}">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection