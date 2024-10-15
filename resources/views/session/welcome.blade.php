@extends('master')
@include('sidebar')
@section('content')
<div class="bg-pink-100 min-h-screen py-10">
    <div class="container mx-auto text-center mt-10 -mr-5" style="margin-top: 100px;">
        <h1 id="welcome-title" class="text-3xl font-bold text-pink-600" 
            onmouseover="changeTextAndImage()" 
            onmouseout="resetTextAndImage()">
            Welcome to Our Page
        </h1>
        <div class="image-container relative inline-block">
            <img id="welcome-image" src="{{ url('img/welcome.HEIC') }}" alt="Welcome" class="transition-transform duration-500" style="width: auto; height: auto; max-width: 100%; max-height: 300px; object-fit: cover;">
        </div>
    </div>
</div>

<script>
    function changeTextAndImage() {
        document.getElementById('welcome-title').innerText = 'Please Log In First';
        document.getElementById('welcome-image').style.transform = 'translateX(-100%)';
        setTimeout(() => {
            document.getElementById('welcome-image').src = '{{ url("img/login.HEIC") }}'; 
            document.getElementById('welcome-image').style.transform = 'translateX(0)';
        }, 500); 
    }

    function resetTextAndImage() {
        document.getElementById('welcome-title').innerText = 'Welcome to Our Page';
        document.getElementById('welcome-image').style.transform = 'translateX(-100%)';
        setTimeout(() => {
            document.getElementById('welcome-image').src = '{{ url("img/welcome.HEIC") }}'; 
            document.getElementById('welcome-image').style.transform = 'translateX(0)';
        }, 500);
    }
</script>

<style>
    .image-container {
        overflow: hidden;
        max-width: 100%; 
        max-height: 300px; 
    }
</style>
@endsection