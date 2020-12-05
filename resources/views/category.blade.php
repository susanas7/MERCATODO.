@extends('layouts.app')

@section('content')

<div class="row">

<div class="filter">
  <h6> Categorias </h6>
    @foreach($category as $cat)
      <a class="btn tbn-link" href="{{route('category', $cat->id )}}">{{$cat->title}}</a>
    @endforeach
</div>
      <div class="card" id="box-search-crud">
        <div class="card-body">
        <form action=" {{route('home')}} ">
          <div class="row">
            <div class="col" >
              <input type="search" name="title" class="form-control form-control-navbar" placeholder="Buscar">
            </div>
            <div class="col">
            <button type="submit" id="btn-search-crud" class="btn btn-link">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
            </svg>
              </button>
            <a href="{{ route('home') }}" id="btn-refresh-crud" class="btn btn-link">Regresar</a>
            </div>
          </div>
        </form>
        </div>
      </div>
    <br>

</div>

<div class="container2">
  @foreach($categories as $product)
    <div class="card">
        <a href="{{route('home.show', $product->id) }}" id="btn-show-home" >
          <img src="{{ $product->get_image }}">
        </a>
        <h4>{{$product->title}}</h4>
        <p>{{$product->slug}}</p>
        <p class="price">$ {{number_format($product->price)}}</p>
        @if(auth()->user())
          <a class="add" href="{{route('user.addToCart', ['id' => $product->id ])}}">Agregar</a> 
        @endif
    </div>
  @endforeach
</div>
@endsection