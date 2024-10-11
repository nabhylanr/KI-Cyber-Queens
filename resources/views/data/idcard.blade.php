@extends('master')
@include('navbar')
@php
$homeController = app('App\Http\Controllers\HomeController');
@endphp
@section('content')
<div class="container mx-auto">
    <div class="text-center my-16">
        <div class="col">
            <h1 class="text-5xl font-bold">{{ $user->username }}'s ID Card</h1>
            <br />
        </div>
    </div>

    <div id="mycard" class="flex justify-center space-x-4">
        <div class="w-full max-w-lg bg-white rounded-lg shadow-md p-6">
            <div class="flex flex-col">
                <div class="mb-5">
                    <label class="font-bold text-xl mb-3">Decrypt key from your email</label>
                    <textarea id="encsymkey" rows="5" class="w-full border border-gray-300 p-3 rounded-md"
                        name="encsymkey" placeholder="Enter the key from your email"></textarea>
                </div>

                <div class="flex justify-end mb-5">
                    <button id="submitButton1" class="bg-gray-800 text-white px-4 py-2 rounded-md">Submit</button>
                </div>

                <div class="mb-3">
                    <label class="font-bold text-xl mb-3">Here is your symmetric key</label>
                    <textarea id="outputTextarea" class="w-full border border-gray-300 p-3 rounded-md" rows="2" readonly></textarea>
                </div>
            </div>
        </div>

        <div class="w-full max-w-lg bg-white rounded-lg shadow-md p-6">
            <div class="flex flex-col">
                <div class="mb-5">
                    <label class="font-bold text-xl mb-3">Symmetric Key</label>
                    @if($inbox !== null)
                    <input type="hidden" id="realsymkey" value="{{$inbox->sym_key}}">
                    @endif
                    <textarea id="symkey" rows="5" class="w-full border border-gray-300 p-3 rounded-md"
                        name="symkey" placeholder="Enter the symmetric key"></textarea>
                </div>

                <div class="flex justify-end mb-5">
                    <button id="submitButton2" class="bg-gray-800 text-white px-4 py-2 rounded-md">Submit</button>
                </div>

                <form action="/home/inbox/idcard/{{(int)$aesuser->user_id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5 flex justify-between items-center">
                        <label class="font-bold text-xl">Not requested yet?</label>
                        <button class="bg-gray-800 text-white px-4 py-2 rounded-md" type="submit">Request</button>
                    </div>
                </form>

                <div class="mb-2 hidden" id="hiddendata">
                    <label class="font-bold text-xl mb-2">Here is {{ $user->username }}'s ID Card</label>
                    @php
                    $akey = null;
                    if ($inbox !== null) {
                        $akey = str_replace('/', '', $inbox->sym_key);
                    }
                    @endphp

                    @if($akey !== null)
                    <a href="/download/aes/id_card/{{ $aesuser->user_id }}/{{ $akey }}"
                        class="bg-blue-600 text-white px-3 py-2 rounded-md">Download</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('submitButton1').addEventListener('click', function () {
        var inputValue = document.getElementById('encsymkey').value;

        if (inputValue.trim() !== '') {
            $.ajax({
                url: '/home/data/id_card/{{$user->id}}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    encsymkey: inputValue
                },
                success: function (response) {
                    console.log(response);
                    document.getElementById('outputTextarea').value = response.decrypted;
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
