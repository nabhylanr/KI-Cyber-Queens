@extends('master')
@include('navbar')

@php
    $homeController = app('App\Http\Controllers\HomeController');
@endphp

@section('content')
<div class="bg-pink-100 min-h-screen py-10"> 
    <div class="container mx-auto bg-white p-8 rounded-lg shadow-md"> 
        <h1 class="text-center text-4xl text-pink-600 font-bold mb-10">Edit Your Profile</h1>
        <form action="/home" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
        
                <div class="mb-6">
                <label class="block text-lg text-pink-600 font-semibold mb-2" for="fullname">Full Name</label>
                <input type="text" id="fullname" class="form-input mt-2 text-pink-600 block w-full border border-gray-300 rounded-md" 
                        name="fullname" placeholder="Enter your Full Name" 
                        value="{{ $homeController->AESdecrypt($aess->first()->fullname, $aess->first()->fullname_key, $aess->first()->fullname_iv, 0) }}">
                @error('fullname')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-lg text-pink-600 font-semibold mb-2" for="id_card">ID Card</label>
                <input type="file" id="id_card" class="form-input mt-1 text-pink-600 block w-full border border-gray-300 rounded-md" 
                        name="id_card">
                @error('id_card')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-lg text-pink-600 font-semibold mb-2" for="document">Document</label>
                <input type="file" id="document" class="form-input mt-1 text-pink-600 block w-full border border-gray-300 rounded-md" 
                        name="document">
                @error('document')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-lg text-pink-600 font-semibold mb-2" for="video">Video</label>
                <input type="file" id="video" class="form-input mt-1 text-pink-600 block w-full border border-gray-300 rounded-md" 
                    name="video">
                @error('video')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button class="bg-gray-800 text-white bg-pink-600 hover:bg-pink-500 py-2 px-4 rounded hover:bg-gray-700" type="submit">Replace</button>
        </form>
    </div>
</div>
@endsection
