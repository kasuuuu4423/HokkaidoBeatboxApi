@extends('layout/layout')
@section('content')
@include('playlist/_form', ['target' => 'store'])
@endsection