@inject('model','App\Product')

@extends('layouts.admin')
@section('page_title')
Products
@endsection
@section('small_title')
Products
@endsection
@section('card_title')
Add room price
@endsection
@section('card_body')

<div class="col-md-6">
{!! Form::model($model, ['action' => 'ProductController@store','enctype'=>'multipart/form-data']) !!}
                    @include('partials.validation_errors')
                    @include('product.form')
                {!! Form::close() !!}
</div>

@endsection