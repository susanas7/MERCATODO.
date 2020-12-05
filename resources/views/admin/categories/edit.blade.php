@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-4">
        @include('fragment.errors')
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar usuario</div>

                <div class="card-body">
                    <form action="{{route('admin.categories.update', $category)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label name="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input type="text" name="title" class="form-control" value="{{$category->title}}" >
                            </div>
                        </div>
                        <div class="form-group"><P ALIGN=center>
                        </div>
                        <button class="btn btn-success" type="submit" >Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
