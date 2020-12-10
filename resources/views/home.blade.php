@extends('layouts.app')

@section('content')

<section class="container-home">
  <div class="left-navigation-home">
    <div class="categories">
      @foreach($categories as $cat)
        <a class="btn tbn-link" href="{{route('category', $cat->id )}}">{{$cat->title}}</a><br>
      @endforeach
    </div>
  </div>
  <div class="void-navigation-home"></div>
  <div class="search-input-home">
    <div>
      <form action=" {{route('home')}} ">
        <input type="search" name="title" placeholder="Search..." >
        <a href="{{ route('home') }}">x
        </a>
      </form>
    </div>
  </div>
  <div class="content-home">
      @foreach($products as $product)
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
        {{$products->links()}} 
      @endforeach
  </div>
</section>


@endsection

<!--<div class="table">
<div class="th">

</div>
  <div class="th">
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
</div>
<div class="container-home">
  @foreach($products as $product)
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
{{$products->links()}} 
<div class="footer" id="footer">
            <div id="footer-div">
                <h2>Mercatodo</h2>
                <h7>2020 ©</h7>    
            </div>
            <div id="footer-subtitle" align="right">
                <h4>Contactenos</h4>
                <h6>267-37-29 / 300-738-2903</h6>
                <h6>mercatodo@support.com.co</h6>  
            </div>
        </div>-->