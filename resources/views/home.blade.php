@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card" id="box-search-crud">
        <div class="card-body">
        <h6>Busqueda de productos</h6>
        <form action=" {{route('home')}} ">
          <div class="row">
            <div class="col" >
              <input type="search" name="title" class="form-control form-control-navbar" placeholder="Nombre">
            </div>
            <div class="col">
            <button type="submit" id="btn-search-crud" class="btn btn-link">Buscar</button>
            <a href="{{ route('home') }}" id="btn-refresh-crud" class="btn btn-link">Regresar</a>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div><br>

<div class="container">
    <div class="col-md-12">
        <div class="card" id="box-home">
            <div class="card-header"> Bienvenido</div>
            <div class="card-header"><P ALIGN=center> {{ $products->total() }} productos | página {{ $products->currentPage() }} de {{ $products->lastpage() }}</div>
            <div class="card-header justify-content-center">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-4 tect-md-center" id="row-home" align="center">
                          <br><a class="btn btn-light" href="{{route('home.show', $product->id) }}"> <h3>{{ $product->title }}</h3></a>
                            <img src="{{ $product->get_image }}" class="card-img-top">
                            <h4>Precio COP {{ number_format($product->price, 2) }} </h4>
                            <a class="btn btn-link" href="{{route('home.show', $product->id) }}" id="btn-show-home" >Detalles</a>
                            <a href="{{route('addToCart', ['id' => $product->id ])}}" type="button" class="btn btn-link" id="btn-add-home">Agregar</a> 
                        </div>
                    @endforeach
                </div>
                <br>
                {{$products->links()}}  
            </div>                 
        </div>
    </div>
</div>
@endsection
