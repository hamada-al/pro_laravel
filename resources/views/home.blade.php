@extends('layouts.admin')
@section('page_title')
Home
@endsection
@section('small_title')
Admin Home
@endsection
@section('card_title')
<h5 style="display:inline">Welcome,</h5> {{auth()->user()->name}}
@endsection
@section('card_body')
Welcome to blood bank dashboard
@endsection