@extends('master')
@include('navbar')

@php
$homeController = app('App\Http\Controllers\HomeController');
@endphp

@section('content')
<div class="bg-gray-200 min-h-screen py-10">
    @if(count($aess) > 0)
    <div class="container py-5 h-auto">
        <div class="flex justify-center">
            <div class="bg-white shadow-md rounded-lg mb-3 w-full max-w-4xl">
                <div class="flex">
                    <div class="w-1/3 bg-gradient-to-r from-blue-500 to-blue-700 flex flex-col justify-center items-center text-center text-white rounded-l-lg p-5">
                        <img src="{{ url('img/profile_user.svg') }}" alt="Avatar" class="w-36 h-36 rounded-full" />
                        <h2 class="text-2xl font-bold mt-3">{{ Auth::user()->username }}</h2>
                        <a href="/sign/{{ Auth::user()->id }}" class="bg-blue-600 hover:bg-blue-500 text-white py-2 px-4 rounded">Sign PDF</a>
                        
                        @if(session('error'))
                        <div class="bg-red-500 text-white p-2 rounded mt-2">{{ session('error') }}</div>
                        @endif
                        @if(session('success'))
                        <div class="bg-green-500 text-white p-2 rounded mt-2">{{ session('success') }}</div>
                        @endif
                    </div>
                    <div class="w-2/3">
                        <div class="p-4">
                            <h2 class="text-xl font-bold">AES</h2>
                            <hr class="mt-0 mb-4" />
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 pt-1">
                                @foreach ($aess as $aes)
                                <div class="mb-3">
                                    <h6 class="font-semibold">Full Name</h6>
                                    <p class="text-gray-600">{{ $homeController->AESdecrypt($aes->fullname, $aes->fullname_key, $aes->fullname_iv, 0) }}</p>
                                </div>
                                <div class="mb-3">
                                    <h6 class="font-semibold">ID Card</h6>
                                    @php
                                    $akey = str_replace('/', '', $aes->id_card_key);
                                    @endphp
                                    <a href="/download/aes/id_card/{{$aes->user_id}}/{{$akey}}" class="bg-blue-600 text-white py-1 px-2 rounded btn">Download</a>
                                </div>
                                <div class="mb-3">
                                    <h6 class="font-semibold">Document</h6>
                                    <a href="/download/aes/document/{{$aes->user_id}}/{{$bkey}}" class="bg-blue-600 text-white py-1 px-2 rounded btn">Download</a>
                                </div>
                                <div class="mb-3">
                                    <h6 class="font-semibold">Video</h6>
                                    <a href="/download/aes/video/{{$aes->user_id}}/{{$ckey}}" class="bg-blue-600 text-white py-1 px-2 rounded btn">Download</a>
                                </div>
                                @endforeach
                            </div>
                            <h2 class="text-xl font-bold mt-4">RC4</h2>
                            <hr class="mt-0 mb-4" />
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 pt-1">
                                @foreach ($rc4s as $rc4)
                                <div class="mb-3">
                                    <h6 class="font-semibold">Full Name</h6>
                                    <p class="text-gray-600">{{ $homeController->Rc4decrypt($rc4->fullname, $rc4->key, 0) }}</p>
                                </div>
                                <div class="mb-3">
                                    <h6 class="font-semibold">ID Card</h6>
                                    @php
                                    $dkey = str_replace('/', '', $rc4->key);
                                    @endphp
                                    <a href="/download/rc4/id_card/{{$rc4->user_id}}/{{$dkey}}" class="bg-gray-600 text-white py-1 px-2 rounded btn">Download</a>
                                </div>
                                <div class="mb-3">
                                    <h6 class="font-semibold">Document</h6>
                                    <a href="/download/rc4/document/{{$rc4->user_id}}/{{$dkey}}" class="bg-gray-600 text-white py-1 px-2 rounded btn">Download</a>
                                </div>
                                <div class="mb-3">
                                    <h6 class="font-semibold">Video</h6>
                                    <a href="/download/rc4/video/{{$rc4->user_id}}/{{$dkey}}" class="bg-gray-600 text-white py-1 px-2 rounded btn">Download</a>
                                </div>
                                @endforeach
                            </div>
                            <h2 class="text-xl font-bold mt-4">DES</h2>
                            <hr class="mt-0 mb-4" />
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 pt-1">
                                @foreach ($dess as $des)
                                <div class="mb-3">
                                    <h6 class="font-semibold">Full Name</h6>
                                    <p class="text-gray-600">{{ $homeController->Desdecrypt($des->fullname, $des->key, $des->iv, 0) }}</p>
                                </div>
                                <div class="mb-3">
                                    <h6 class="font-semibold">ID Card</h6>
                                    @php
                                    $ekey = str_replace('/', '', $des->key);
                                    @endphp
                                    <a href="/download/des/id_card/{{$des->user_id}}/{{$ekey}}" class="bg-green-600 text-white py-1 px-2 rounded btn">Download</a>
                                </div>
                                <div class="mb-3">
                                    <h6 class="font-semibold">Document</h6>
                                    <a href="/download/des/document/{{$des->user_id}}/{{$ekey}}" class="bg-green-600 text-white py-1 px-2 rounded btn">Download</a>
                                </div>
                                <div class="mb-3">
                                    <h6 class="font-semibold">Video</h6>
                                    <a href="/download/des/video/{{$des->user_id}}/{{$ekey}}" class="bg-green-600 text-white py-1 px-2 rounded btn">Download</a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <h1 class="text-center text-4xl font-bold mt-20">Hi {{ Auth::user()->username }}, please complete your profile!</h1>
    @endif
</div>
@endsection
