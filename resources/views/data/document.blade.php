@extends('master')
@include('sidebar')
@php
$homeController = app('App\Http\Controllers\HomeController');
@endphp
@section('content')
<div class="bg-pink-100 min-h-screen py-10">    
    <div class="container mx-auto bg-white p-8 rounded-lg shadow-md max-w-2xl mt-20" style="margin-right: 260px;">
        <h1 class="text-center text-xl text-pink-600 font-bold mb-10 leading-tight tracking-tight md:text-2xl">{{ $user->username }}'s Document</h1>

        <form action="/home/inbox/document/{{(int)$aesuser->user_id}}" method="post" enctype="multipart/form-data" class="flex flex-col">
            @csrf
            <div class="flex justify-between items-center">
                <label class="font-bold text-sm text-pink-600">Not requested yet?</label>
                <button class="bg-pink-600 hover:bg-pink-500 text-white px-3 py-1 rounded-md text-sm" type="submit">Request</button>
            </div>
        </form>

        <div class="flex flex-col mt-4">
            <label class="font-bold text-sm text-pink-600 mb-2">Decrypt key from your email</label>
            <textarea id="encsymkey" rows="4" class="w-full border border-gray-300 p-2 rounded-md text-sm" name="encsymkey" placeholder="Enter the key from your email"></textarea>
            <div class="flex justify-end mt-2">
                <button id="submitButton1" class="bg-pink-600 hover:bg-pink-500 text-white px-3 py-1 rounded-md text-sm">Submit</button>
            </div>
        </div>

        <div class="flex flex-col mt-4 hidden" id="symmetricKeySection">
            <label class="font-bold text-sm text-pink-600 mb-2">Here is your symmetric key</label>
            <textarea id="outputTextarea" class="w-full border border-gray-300 p-2 rounded-md text-sm" rows="1" readonly></textarea>
        </div>

        <div class="flex flex-col mt-4 hidden" id="symmetricKeyInputSection">
            <label class="font-bold text-sm text-pink-600 mb-2">Symmetric Key</label>
            @if($inbox !== null)
            <input type="hidden" id="realsymkey" value="{{$inbox->sym_key}}">
            @endif
            <textarea id="symkey" rows="4" class="w-full border border-gray-300 p-2 rounded-md text-sm" name="symkey" placeholder="Enter the symmetric key"></textarea>
            <div class="flex justify-end mt-2">
                <button id="submitButton2" class="bg-pink-600 hover:bg-pink-500 text-white px-3 py-1 rounded-md text-sm">Submit</button>
            </div>
        </div>

        <div class="hidden mt-4" id="hiddendata">
            <label class="font-bold text-sm text-pink-600 mb-2">Here is {{ $user->username }}'s Document</label>
            @php
            $bkey = null;
            if ($inbox !== null) {
                $bkey = str_replace('/', '', $inbox->sym_key);
            }
            @endphp

            @if($bkey !== null)
            <a href="/download/aes/document/{{ $aesuser->user_id }}/{{ $bkey }}" class="bg-pink-600 hover:bg-pink-500 text-white px-3 py-1 rounded-md text-sm">Download</a>
            @endif
        </div>

        <form action="/verify/{{(int)$aesuser->user_id}}" method="post" enctype="multipart/form-data" class="flex flex-col space-y-4 mt-6">
                @csrf
                <div class="flex flex-col">
                    <label class="font-bold text-sm text-pink-600 mb-2">Verify Document</label>
                    <input type="file" class="w-full border border-gray-300 p-2 rounded-md text-sm" name="document" required>
                    @error('document')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button id="verifybutton" class="bg-pink-600 hover:bg-pink-500 text-white px-3 py-1 rounded-md text-sm mt-1">Submit</button>
                </div>
            </form>

            @if(session('status') == 'success')
            <div class="flex flex-col mt-5 space-y-4">
                <div class="flex flex-col">
                    <label class="font-bold text-sm text-pink-600 mb-2">Digest from Document</label>
                    <textarea class="w-full border border-gray-300 p-2 rounded-md text-sm" rows="2" readonly>{{session('digest')}}</textarea>
                </div>
                <div class="flex flex-col">
                    <label class="font-bold text-sm text-pink-600 mb-2">Decrypted Digital Signature</label>
                    <textarea class="w-full border border-gray-300 p-2 rounded-md text-sm" rows="2" readonly>{{session('decrypted_digsig')}}</textarea>
                </div>
                @if(session('digest') == session('decrypted_digsig'))
                <div class="bg-green-100 text-green-700 p-4 rounded">Digest and decrypted digital signature match! Document is verified.</div>
                @else
                <div class="bg-red-100 text-red-700 p-4 rounded">Digest and decrypted digital signature do not match. Document integrity is compromised.</div>
                @endif
            </div>
            @elseif(session('status') == 'failed')
            <div class="bg-red-100 text-red-700 p-4 rounded">{{session('message')}}</div>
            @endif
            </div>
    </div>
</div>

<script>
    document.getElementById('submitButton1').addEventListener('click', function () {
        var inputValue = document.getElementById('encsymkey').value;

        if (inputValue.trim() !== '') {
            $.ajax({
                url: '/home/data/document/{{$user->id}}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    encsymkey: inputValue
                },
                success: function (response) {
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