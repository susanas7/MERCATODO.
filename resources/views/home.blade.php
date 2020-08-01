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
                            <br><br><img src="{{ $product->get_image }}" class="card-img-top">
                            <!--<img src="images/{{$product->img_route}}" width="75">-->
                            <h4>{{ $product->title }}</h4>
                            <h4>Precio COP {{ $product->price }} </h4>
                            <a class="btn btn-link" data-toggle="modal" data-target="#{{$product->title}}" id="btn-show-home" >Detalles</a>
                            <button type="button" class="btn btn-link" id="btn-add-home">Agregar</button>                                            
                            <!--ventana emergente-->
                            <div class="modal fade" id="{{$product->title}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="muModalLabel">{{$product->title}}</h4>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                        </div>
                                        <div class="modal-body">
                                            <div align="center">
                                            <img src="{{ URL::to('/images/' . $product->img_route) }}" width="250">
                                            </div>
                                            <p><h4>{{$product->slug}}</h4></p>                                 
                                        </div>
                                        <div class="modal-footer">
                                            <div align="center">
                                                <span class="label label-success"> Precio: ${{number_format($product->price)}}</span>
                                            </div>
                                            <button type="button" class="btn btn-success">Agregar</button>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
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
