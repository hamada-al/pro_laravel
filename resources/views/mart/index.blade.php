@extends('layouts.admin')

@section('page_title')
Mart
@endsection
@section('small_title')
Mart
@endsection
@section('card_title')
List of mart
@endsection
@section('card_body')
<div class="text-center">
</div>
{!!Form::open(['action'=>['MartController@create'], 'method'=>'get'])
        !!}
<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add mart</button>
{!!Form::close()!!}
<br>@include('flash::message')
<br>
    @if(count($records))
    <div class="table-responsive">

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Image</th>
      <th scope="col">Edit products</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    @foreach($records as $r)
    <tr>
      <th class="align-middle" scope="row">{{$loop->iteration}}</th>
      <td class="align-middle">{{$r->name}}</td>
      <td class="align-middle">{{$r->price}}</td>
      <td class="align-middle">
        <div class="text-left">
          <img src="{{asset('images').'/'.$r->image}}" height="100px" width="100px">
        </div>
        {{$r->image}}
        <br>

      </td>

      <td class="align-middle"><a href="{{route('product.index',$r->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
      <td class="align-middle"><a href="{{route('mart.edit',$r->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
      <td class="align-middle">
      {!!Form::open(['action'=>['MartController@destroy',$r->id], 'method'=>'delete'])
        !!}
        <button class="btn btn-danger"><i class="fa fa-trash" ></i></button>
        {!!Form::close()!!}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div
@else
                    <div class="alert alert-danger" role="alert">
                        No data
                    </div>
                @endif
@endsection
