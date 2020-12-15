@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('products.fields.product'): {{$product->title}}</div>

                <div class="card-body">
                        <div class="form-group row">
                        <img src="{{ $product->get_image }}" class="card-img-top">
                        </div>
                        <div class="form-group row">
                            <label name="name" class="col-md-4 col-form-label text-md-right">@lang('products.fields.product'):</label>

                            <div class="col-md-6">
                            <label name="name" class="col-md-8 col-form-label text-md-center">{{$product->title}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">@lang('products.fields.slug'):</label>

                            <div class="col-md-6">
                            <label name="name" class="col-md-8 col-form-label text-md-center">{{$product->slug}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="role" class="col-md-4 col-form-label text-md-right">@lang('products.fields.category'):</label>

                            <div class="col-md-6">
                                <label name="name" class="col-md-8 col-form-label text-md-center">{{ $product->category->title ?? ''}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="status" class="col-md-4 col-form-label text-md-right">@lang('products.fields.status'):</label>

                            <div class="col-md-6">
                                <label name="name" class="col-md-8 col-form-label text-md-center">
                                @if($product->is_active==1)
                                    @lang('products.fields.active')
                                @else
                                    @lang('products.fields.inactive')
                                @endif
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">@lang('products.fields.created_at'):</label>

                            <div class="col-md-6">
                            <label name="name" class="col-md-8 col-form-label text-md-center">{{$product->created_at}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="email" class="col-md-4 col-form-label text-md-right">@lang('products.fields.updated_at'):</label>

                            <div class="col-md-6">
                            <label name="name" class="col-md-8 col-form-label text-md-center">{{$product->updated_at}}</label>
                            </div>
                        </div>
                        <div class="form-group"><P ALIGN=center>
                        </div>
                        <a href="{{route ('admin.products.index')}}">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection