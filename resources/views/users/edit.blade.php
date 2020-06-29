@extends('layouts.app')
@section('content')
<html>
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<form action="{{route('users.edit' , $user)}}" method="PUT" {{csrf_token()}}>
  @csrf
  @method('PUT')
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <th><label name="name">Nombre</label></th>
  <input type="text" name="name" placeholder="{{$user->name}}">
  <th><label name="email">Email</label></th>
  <input type="text" name="email" placeholder="{{$user->email}}">
  <th><label name="role">Rol</label></th>
  <input type="text" name="role" placeholder="{{$user->role}}">
  <th><label name="status">Estatus</label></th>
  <input type="text" name="status" placeholder="{{$user->status}}">
<form method="PUT" action="('users.update')">
  @csrf
  <button type="submit" >Actualizar</button>
</form>
