@extends('master')
@include('sidebar')
@php
$homeController = app('App\Http\Controllers\HomeController');
@endphp
@section('content')
<div class="bg-pink-100 min-h-screen py-10">    
    <div class="container mx-auto bg-white p-8 rounded-lg shadow-md max-w-2xl mt-20" style="margin-right: 260px;">
        <h1 class="text-center text-xl text-pink-600 font-bold mb-10 leading-tight tracking-tight md:text-2xl">{{ $user->username }}'s Fullname</h1>

        <form action="/home/inbox/fullname/{{(int)$aesuser->user_id}}" method="post" enctype="multipart/form-data" class="mb-6">
            @csrf
            <div class="flex justify-between items-center">
                <label class="font-bold text-sm text-pink-600">Not requested yet?</label>
                <button class="bg-pink-600 hover:bg-pink-500 text-white px-3 py-1 rounded-md text-sm" type="submit">Request</button>
            </div>
        </form>
        
        <div class="flex flex-col mb-6">
            <label class="font-bold text-sm text-pink-600 mb-2">Decrypt key from your email</label>
            <textarea id="encsymkey" rows="4" class="w-full border border-gray-300 p-2 rounded-md text-sm" name="encsymkey" placeholder="Enter the key from your email"></textarea>
            <div class="flex justify-end mt-2">
                <button id="submitButton1" class="bg-pink-600 hover:bg-pink-500 text-white px-3 py-1 rounded-md text-sm">Submit</button>
            </div>
        </div>

        <div class="flex flex-col mb-6 hidden" id="symmetricKeySection">
            <label class="font-bold text-sm text-pink-600 mb-2">Here is your symmetric key</label>
            <textarea id="outputTextarea" class="w-full border border-gray-300 p-2 rounded-md text-sm" rows="1" readonly disabled></textarea>
        </div>

        <div class="flex flex-col mb-6 hidden" id="symmetricKeyInputSection">
            <label class="font-bold text-sm text-pink-600 mb-2">Symmetric Key</label>
            @if($inbox !== null)
            <input type="hidden" id="realsymkey" value="{{$inbox->sym_key}}">
            @endif
            <textarea id="symkey" rows="4" class="w-full border border-gray-300 p-2 rounded-md text-sm" name="symkey" placeholder="Enter the symmetric key"></textarea>
            <div class="flex justify-end mt-2">
                <button id="submitButton2" class="bg-pink-600 hover:bg-pink-500 text-white px-3 py-1 rounded-md text-sm">Submit</button>
            </div>
        </div>

        <div class="hidden" id="hiddendata">
            <label class="font-bold text-sm text-pink-600 mb-2">Here is {{ $user->username }}'s Fullname</label>
            <p class="text-gray-700">{{ $homeController->AESdecrypt($aesuser->fullname, $aesuser->fullname_key, $aesuser->fullname_iv, 0) }}</p>
        </div>
    </div>
</div>

<script>
    document.getElementById('submitButton1').addEventListener('click', function () {
        var inputValue = document.getElementById('encsymkey').value;

        if (inputValue.trim() !== '') {
            $.ajax({
                url: '/home/data/fullname/{{(int)$aesuser->user_id}}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    encsymkey: inputValue
                },
                success: function (response) {
                    console.log(response);
                    document.getElementById('outputTextarea').value = response.decrypted;

                    document.getElementById('symmetricKeySection').classList.remove('hidden');
                    document.getElementById('symmetricKeyInputSection').classList.remove('hidden');
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    });

    document.getElementById('submitButton2').addEventListener('click', function () {
        var inputValue = document.getElementById('symkey').value;
        var realsymkey = document.getElementById('realsymkey').value;
        var hiddenDataDiv = document.getElementById('hiddendata');

        if (inputValue == realsymkey) {
            hiddenDataDiv.classList.remove('hidden');
        } else {
            hiddenDataDiv.classList.add('hidden');
        }
    });
</script>
@endsection