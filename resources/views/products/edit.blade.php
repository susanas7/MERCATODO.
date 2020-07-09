@extends('layouts.app')
@section('content')

<form action="{{route('products.update', $product)}}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <th><label name="title">Nombre</label></th>
  <input type="text" name="title" value="{{$product->title}}">
  <th><label name="slug">Descripcion</label></th>
  <input type="text" name="slug" value="{{$product->slug}}">
  <th><label name="price">Precio</label></th>
  <input type="number" name="price" value="{{$product->price}}">
  <th><label name="category_id">Categoria</label></th>
  <input type="number" name="category_id" value="{{$product->category_id}}">
  <input accept="image/*" type="file" name="file" >
  <button type="submit" >Actualizar</button>
</form>

@endsection