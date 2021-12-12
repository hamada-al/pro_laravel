@extends('layouts.admin')
@section('page_title')
Product
@endsection
@section('small_title')
Product
@endsection
@section('card_title')
Edit product
@endsection
@section('card_body')
<div class="col-md-6">
@include('flash::message')
                <div class="text-left">
                <img src="{{asset('images').'/'.$model->image}}" height="300px" width="300px">
                </div>
                <br>

                {!! Form::model($model, [
                    'action' => ['ProductController@update',$model->id],
                    'method' => 'put'
                ]) !!}
                    @include('flash::message')
                    @include('partials.validation_errors')
                    @include('product.form')
                {!! Form::close() !!}
    </div>

@endsection