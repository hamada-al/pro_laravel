@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card" style="border-radius: 15px;">

                <div class="card-body p-4">

                    @if(count($records))
                    <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th width="10%" scope="col" >#</th>
                      <th width="20%" scope="col">Name</th>
                      <th width="10%" scope="col">Price</th>
                      <th scope="col" class="text-center">Image</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($records as $r)
                    <tr>
                      <th class="align-middle" scope="row">{{$loop->iteration}}</th>
                      <td class="align-middle">{{$r->name}}</td>
                      <td class="align-middle">{{$r->price}}</td>
                      <td class="align-middle" >
                        <div class="text-center">
                          <img src="{{asset('images').'/'.$r->image}}" height="200px">
                        </div>

                        <br>

                      </td>

                    </tr>
                    @endforeach
                  </tbody>
                    </table>
                    </div>
                    @else
                <div class="alert alert-danger" role="alert">
                    No data
                </div>
            @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
