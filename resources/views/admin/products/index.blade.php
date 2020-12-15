@extends('layouts.app')
@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card" id="box-search-crud">
        <div class="card-body">
        <form action=" {{route('admin.products.index')}} ">
          <div class="row">
            <div class="col" >
              <input type="text" name="title" class="form-control form-control-navbar" value="{{old('title' , request('title'))}}">
            </div>
            <div class="col">
            <button type="submit" id="btn-search-crud" class="btn btn-link">Buscar</button>
            <a href="{{ route('admin.products.index') }}" id="btn-refresh-crud" class="btn btn-link">Regresar</a>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div><br>

<div class="container" >
    <div class="row justify-content-center" >
        <div class="col-md-10">
            <div class="card" id="box-crud" >
                <div class="card-header"><P ALIGN=center> {{ $products->total() }} @lang('products.fields.products') | @lang('products.fields.page')  {{ $products->currentPage() }} de {{ $products->lastpage() }} </div>
                  <div class="card-body">
                  @isset($errors)
                      <div class="row justify-content-center">
                          <div class="col-md-8">
                              @include('fragment.errors')
                          </div>
                      </div>
                      @endisset
                    <div>
                    <table class="egt">
                      <tr>
                        <td><a href="{{route('admin.products.create')}}" class="btn btn-primary">@lang('products.buttons.create')</a></td>

                        <td><form action="{{route('admin.products.export')}}">
                        <button type="submit" class="btn btn-primary">@lang('products.buttons.export') </button>
                      </form></td>

                        <td><form action="{{route('admin.products.import')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                          @lang('products.buttons.import') 
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('products.buttons.import') @lang('products.fields.products')  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <form action="{{route('admin.products.import')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h6>@lang('products.messages.for-import')</h6>
                        <img src="{{ url('storage/images/import.example.png') }}" class="card-img-top">
                        <input type="file" name="file" required>
                      </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button typ="submit" class="btn btn-link">@lang('products.buttons.import')</button>
                        </form></td>

                      </tr>
                      </div>
                    </div>
                  </div>
                </div>

                        
                    </div><br>
                    <table class="table">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>&nbsp;</th>
                        <th>@lang('products.fields.product')</th>
                        <th>@lang('products.fields.slug')</th>
                        <th>@lang('products.fields.price')</th>
                        <th>@lang('products.fields.status')</th>
                        <th>@lang('products.fields.category')</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                      </tr>
                      </thead>
                        @foreach ($products as $product)
                        <tr>
                          <td>{{ $product->id }}</td>
                          <td><img src="{{ $product->get_image }}" class="card-img-top"> </td>
                          <td>{{ $product->title }}</td>
                          <td>{{$product->slug}}</td>
                          <td>{{ number_format($product->price, 2) }}</td>
                          <td>
                          @if($product->is_active==1)
                            @lang('products.fields.active')
                            @else
                              @lang('products.fields.inactive')
                            @endif
                          </td>
                          <td> {{$product->category_title ?? ''}} </td>
                          <td></td>
                          <td>
                          @can('ver producto')
                            <a href="{{route('admin.products.show', $product->id) }}" id="show-crud" class="btn btn-link">@lang('products.buttons.view')</a>
                          @endcan
                          </td>
                          <td>
                          @if($product->is_active==1)
                            <a href="{{route('admin.products.changeStatus', $product->id)}}" id="status-crud" class="btn btn-link"
                            >@lang('products.buttons.disable')</a>
                          @else
                            <a href="{{route('admin.products.changeStatus', $product->id)}}" id="status-crud" class="btn btn-link" 
                            >@lang('products.buttons.enable')</a>
                          @endif
                          </td>
                          <td>
                            @can('editar producto')
                              <a class="btn btn-link" id="edit-crud" href="{{route('admin.products.edit', $product->id)}}" >@lang('products.buttons.edit')</a>
                            @endcan
                          </td>
                          <td>
                            @can('eliminar producto')
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" >
                              @method('DELETE')
                              @csrf
                              <input type="submit"
                              value="@lang('products.buttons.delete')"
                              class="btn btn-link"
                              id="delete-crud"
                              onclick="return confirm('¿Desea eliminar?')">
                            </form>
                            @endcan
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{$products->links()}}
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
