@extends('master')
@include('navbar')
@section('content')
<div class="bg-gray-200 min-h-screen py-10">
    <div class="container mx-auto text-center mt-10">
        <h1 class="text-5xl font-bold">Welcome to Our Page</h1>
        <img src="{{ url('img/welcome.svg') }}" alt="" class="mx-auto mt-8">
    </div>
</div>
@endsection
