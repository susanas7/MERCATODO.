@extends('layouts.app')
@section('content')
<form action="{{route('users.update' , $user)}}" method="POST">
  @csrf
  @method('PUT')
  <th><label name="name">Nombre</label></th>
  <input type="text" name="name" value="{{$user->name}}">
  <th><label name="email">Email</label></th>
  <input type="text" name="email" value="{{$user->email}}">
  <th><label name="role">Rol</label></th>
  <input type="text" name="role" value="{{$user->role}}">
  <th><label name="status">Estatus</label></th>
  <input type="text" name="status" value="{{$user->status}}">
  <button type="submit" >Actualizar</button>
</form>
@endsection
