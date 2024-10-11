@extends('master')
@include('navbar')
@php
$homeController = app('App\Http\Controllers\HomeController');
@endphp
@section('content')
<div class="container mx-auto">
    <div class="text-center mb-5" style="margin-top: 100px">
        <div class="col">
            <h1 class="text-center text-4xl font-bold mt-16">{{$user->username}}'s document</h1>
            <br />
        </div>
    </div>

    <div id="mycard" class="flex justify-center">
        <div class="card mb-3 lg:w-1/2 mx-3 bg-white shadow-lg rounded-lg p-5">
            <div class="card-body">
                <div class="flex flex-col">
                    <div class="form-group mb-3">
                        <label class="font-bold text-xl mb-3">Decrypt key from your email</label>
                        <textarea id="encsymkey" rows="5" class="form-control block w-full rounded border-gray-300" name="encsymkey" placeholder="Enter the key from your email"></textarea>
                    </div>

                    <div class="flex justify-end mb-5">
                        <button id="submitButton1" class="bg-gray-800 text-white py-2 px-4 rounded">Submit</button>
                    </div>

                    <div class="mb-3">
                        <label class="font-bold text-xl mb-3">Here is your symmetric key</label>
                        <textarea id="outputTextarea" class="form-control block w-full rounded border-gray-300" rows="2" readonly></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3 lg:w-1/3 mx-3 bg-white shadow-lg rounded-lg p-5">
            <div class="card-body">
                <div class="flex flex-col">
                    <div class="form-group mb-3">
                        <label class="font-bold text-xl mb-3">Symmetric Key</label>
                        @if($inbox !== null)
                        <input type="hidden" id="realsymkey" value="{{$inbox->sym_key}}">
                        @endif
                        <textarea id="symkey" rows="5" class="form-control block w-full rounded border-gray-300" name="symkey" placeholder="Enter the symmetric key"></textarea>
                    </div>

                    <div class="flex justify-end mb-5">
                        <button id="submitButton2" class="bg-gray-800 text-white py-2 px-4 rounded">Submit</button>
                    </div>

                    <form action="/home/inbox/document/{{(int)$aesuser->user_id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-5 flex justify-between items-center">
                            <label class="font-bold text-xl mb-3">Not requested yet?</label>
                            <button class="bg-gray-800 text-white py-2 px-4 rounded">Request</button>
                        </div>
                    </form>

                    <div class="form-group mb-2 p-2 hidden" id="hiddendata">
                        <label class="font-bold text-xl mb-2">Here is {{$user->username}}'s document</label>
                        @php
                        $bkey = null;

                        if ($inbox !== null) {
                        $bkey = str_replace('/', '', $inbox->sym_key);
                        }
                        @endphp

                        @if($bkey !== null)
                        <a href="/download/aes/document/{{ $aesuser->user_id }}/{{ $bkey }}" class="bg-blue-500 text-white py-1 px-3 rounded">Download</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="mycard" class="flex justify-center">
        <div class="card mt-3 mb-5 lg:w-11/12 mx-3 bg-white shadow-lg rounded-lg p-5">
            <div class="card-body">
                <div class="flex flex-col">
                    <form action="/verify/{{(int)$aesuser->user_id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="font-bold text-xl mb-3">Verify Document</label>
                            <input type="file" class="form-control block w-full rounded border-gray-300" name="document" required>
                            @error('document')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <button id="verifybutton" class="bg-gray-800 text-white py-2 px-4 rounded mt-1">Submit</button>
                        </div>
                    </form>

                    @if(session('status') == 'success')
                        <div class="flex mt-5">
                            <div class="form-group w-1/2 mb-3">
                                <label class="font-bold text-xl mb-3">Digest from Document</label>
                                <textarea class="form-control block w-full rounded border-gray-300" rows="2" readonly>{{session('digest')}}</textarea>
                            </div>
                            <div class="form-group w-1/2 mb-3">
                                <label class="font-bold text-xl mb-3">Decrypted Digital Signature</label>
                                <textarea class="form-control block w-full rounded border-gray-300" rows="2" readonly>{{session('decrypted_digsig')}}</textarea>
                            </div>
                        </div>
                        @if(session('digest') == session('decrypted_digsig'))
                        <div class="bg-green-100 text-green-700 p-4 rounded">Digest and decrypted digital signature are the same! The document is verified.</div>
                        @else
                        <div class="bg-red-100 text-red-700 p-4 rounded">Digest and decrypted digital signature are not the same! Something in the document has changed.</div>
                        @endif
                    @elseif(session('status') == 'failed')
                    <div class="bg-red-100 text-red-700 p-4 rounded">{{session('message')}}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('submitButton1').addEventListener('click', function() {
        var inputValue = document.getElementById('encsymkey').value;

        if (inputValue.trim() !== '') {
            $.ajax({
                url: '/home/data/document/{{$user->id}}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    encsymkey: inputValue
                },
                success: function(response) {
                    console.log(response);
                    document.getElementById('outputTextarea').value = response.decrypted;
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    document.getElementById('submitButton2').addEventListener('click', function() {
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
