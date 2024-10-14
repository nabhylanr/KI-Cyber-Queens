@extends('master')
@include('sidebar')

@section('content')
<div class="min-h-screen py-10 bg-cover bg-center relative overflow-hidden" style="background-image: url('/img/bg.jpg');">
    
    <div class="container mx-auto bg-white p-8 rounded-lg shadow-md max-w-md mt-24" style="margin-right: 355px;"> <!-- Added custom left margin -->
        <h1 class="text-center text-4xl text-pink-600 font-bold mb-10">Upload Files</h1>
        <form action="/home" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                    <label for="first_name" class="block mb-2 text-sm font-bold text-gray-900">Full Name</label>
                    <input type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" name="fullname" placeholder="Enter your Full Name" value="{{ old('fullname') }}"/>
                    @error('fullname')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-bold text-gray-900" for="id_card">ID Card</label>
                <input type="file" id="id_card" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" name="id_card" value="{{ old('id_card') }}">
                @error('id_card')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-bold text-gray-900" for="document">Document</label>
                <input type="file" id="document" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" name="document" value="{{ old('document') }}">
                @error('document')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-bold text-gray-900" for="video">Video</label>
                <input type="file" id="video" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" name="video" value="{{ old('video') }}">
                @error('video')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <button class="bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700" type="submit">Submit</button>
        </form>
    </div>
</div>
@endsection
