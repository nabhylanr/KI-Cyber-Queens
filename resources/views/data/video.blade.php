@extends('master')
@include('navbar')
@php
$homeController = app('App\Http\Controllers\HomeController');
@endphp
@section('content')
<div class="container mx-auto">
    <div class="text-center mb-5" style="margin-top: 100px">
        <!-- Center the content -->
        <div class="col">
            <h1 class="text-center text-5xl font-bold mt-24">{{$user->username}}'s video</h1>
            <br />
        </div>
    </div>

    <div id="mycard" class="flex justify-center">
        <div class="mb-3 lg:w-1/2 mx-3 bg-white shadow-md rounded-lg">
            <div class="p-6">
                <div class="flex flex-col">
                    <div class="mb-3">
                        <label class="font-bold text-xl mb-3">Decrypt key from your email</label>
                        <textarea id="encsymkey" rows="5" class="w-full p-2 border border-gray-300 rounded-md"
                            name="encsymkey" placeholder="Enter the key from your email"></textarea>
                    </div>

                    <div class="flex justify-end mb-5">
                        <button id="submitButton1" class="bg-black text-white px-4 py-2 rounded-md" type="submit">
                            Submit
                        </button>
                    </div>

                    <div class="mb-3">
                        <label class="font-bold text-xl mb-3">Here is your symmetric key</label>
                        <textarea id="outputTextarea" class="w-full p-2 border border-gray-300 rounded-md" rows="2"
                            readonly></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3 lg:w-5/12 mx-3 bg-white shadow-md rounded-lg">
            <div class="p-6">
                <div class="flex flex-col">
                    <div class="mb-3">
                        <label class="font-bold text-xl mb-3">Symmetric Key</label>
                        @if($inbox !== null)
                        <input type="hidden" class="w-full p-2 border border-gray-300 rounded-md" id="realsymkey"
                            value="{{$inbox->sym_key}}">
                        @endif
                        <textarea id="symkey" rows="5" class="w-full p-2 border border-gray-300 rounded-md" name="symkey"
                            placeholder="Enter the symmetric key"></textarea>
                    </div>

                    <div class="flex justify-end mb-5">
                        <button id="submitButton2" class="bg-black text-white px-4 py-2 rounded-md" type="submit">
                            Submit
                        </button>
                    </div>
                    {{-- {{ route('mail.video', ['key' => $user->id]) }} --}}
                    <form action="/home/inbox/video/{{(int)$aesuser->user_id}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5 flex justify-between items-center">
                            <label class="font-bold text-xl">Not requested yet?</label>
                            <button class="bg-black text-white px-4 py-2 rounded-md" type="submit">Request</button>
                        </div>
                    </form>

                    <div class="mb-2 hidden" id="hiddendata">
                        <label class="font-bold text-xl mb-2">Here is {{$user->username}}'s video</label>
                        @php
                        $ckey = null;

                        if ($inbox !== null) {
                        $ckey = str_replace('/', '', $inbox->sym_key);
                        }
                        @endphp

                        @if($ckey !== null)
                        <a href="/download/aes/video/{{ $aesuser->user_id }}/{{ $ckey }}"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md">
                            Download
                        </a>
                        @endif
                    </div>
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
                url: '/home/data/video/{{$user->id}}',
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