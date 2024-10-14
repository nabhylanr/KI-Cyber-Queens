@extends('master')
@include('sidebar')

@php
    $homeController = app('App\Http\Controllers\HomeController');
@endphp

@section('content')
<div class="bg-pink-100 min-h-screen py-10">
    <div class="container mx-auto bg-white p-8 rounded-lg shadow-md max-w-lg mt-20" style="margin-right: 320px;">
        <h1 class="text-center text-xl text-pink-600 font-bold mb-10 leading-tight tracking-tight md:text-2xl">Edit Profile</h1>
        <form action="/home" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="mb-6">
                <label class="block mb-2 text-sm font-bold text-pink-600" for="fullname">Full Name</label>
                <input type="text" id="fullname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                       name="fullname" placeholder="Enter your Full Name" 
                       value="{{ $homeController->AESdecrypt($aess->first()->fullname, $aess->first()->fullname_key, $aess->first()->fullname_iv, 0) }}">
                @error('fullname')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-bold text-pink-600" for="id_card">ID Card</label>
                <input type="file" id="id_card" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" 
                       name="id_card">
                @error('id_card')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-bold text-pink-600" for="document">Document</label>
                <input type="file" id="document" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" 
                       name="document">
                @error('document')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-bold text-pink-600" for="video">Video</label>
                <input type="file" id="video" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" 
                       name="video">
                @error('video')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button class="bg-pink-600 text-white py-2 px-4 rounded hover:bg-pink-500" type="submit">Replace</button>
        </form>
    </div>
</div>
@endsection
