@extends('layouts.app')

@section('content')

<section class="container-home">
  <div class="left-navigation-home">
    <div class="categories">
      <h5>Categorias</h5  >
      @foreach($categories as $cat)
        <a class="btn tbn-link" href="{{route('category', $cat->id )}}">{{$cat->title}}</a><br>
      @endforeach
    </div>
  </div>
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
              <a class="add" href="{{route('user.addToCart', ['id' => $product->id ])}}">add +</a> 
            @endif
        </div>
      @endforeach
      {{$products->links()}} 
  </div>
</section>
@endsection