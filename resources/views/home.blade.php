@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
        <h6>Busqueda de productos</h6>
        <form action=" {{route('home')}} ">
          <div class="row">
            <div class="col" >
              <input type="search" name="title" class="form-control form-control-navbar" placeholder="Nombre">
            </div>
            <div class="col" >
              <input type="search" name="slug" class="form-control form-control-navbar" placeholder="Descripcion">
            </div>
            <div class="col">
            <button type="submit" class="btn btn-default">Buscar</button>
            <a href="{{ route('home') }}" class="btn btn-link">Regresar</a>
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
        <div class="card">
            <div class="card-header"> Bienvenido</div>
            <div class="card-header"><P ALIGN=center> {{ $products->total() }} productos | página {{ $products->currentPage() }} de {{ $products->lastpage() }}</div>
            <div class="card-header justify-content-center">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-4 tect-md-center" align="center">
                            <br><br><img src="{{ URL::to('/images/' . $product->img_route) }}" style="width:250px ; heigth:250px">
                            <!--<img src="images/{{$product->img_route}}" width="75">-->
                            <h4>{{ $product->title }}</h4>
                            <h4>Precio COP {{ $product->price }} </h4>
                            <a class="btn btn-primary" data-toggle="modal" data-target="#{{$product->title}}" >Detalles</a>
                            <button type="button" class="btn btn-success">Agregar</button>                                            
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
            </div>                    
        </div>
    </div>
</div>
{{$products->links()}}
@endsection
