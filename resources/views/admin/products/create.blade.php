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
                <div class="card-header">Crear producto</div>

                <div class="card-body">
                    <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label name="title" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input type="text" name="title" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="slug" class="col-md-4 col-form-label text-md-right">Descripcion</label>

                            <div class="col-md-6">
                                <textarea type="text" name="slug" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="category_id" class="col-md-4 col-form-label text-md-right">Categoria</label>

                            <div class="col-md-6">
                                <select name="category_id" id="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"> {{$category->title}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="price" class="col-md-4 col-form-label text-md-right">Precio</label>

                            <div class="col-md-6">
                                <input type="number" name="price" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                          <label name="img_route" class="col-md-4 col-form-label text-md-right"></label>

                          <div class="col-md-6">
                            <input type="file" name="img_route" >
                          </div>
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

