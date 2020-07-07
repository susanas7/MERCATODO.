@extends('layouts.app')
@section('content')

<form action="{{route('products.store')}}" method="POST">
  @csrf
  <th><label name="name">Nombre</label></th>
  <input type="text" name="title">
  <th><label name="slug">Descripcion</label></th>
  <input type="text" name="slug">
  <th><label name="price">Precio</label></th>
  <input type="text" name="price">
  <th><label name="category_id">Categoria</label></th>
  <input type="text" name="category_id">
  <button type="submit" >Crear</button>
</form>

@endsection