@extends('master')
@include('navbar')

@section('content')
<div class="bg-pink-100 min-h-screen py-10">
    <div class="text-center mb-5">
        <h1 class="text-4xl font-bold mb-4">Inboxes</h1>
    </div>
    
    <div id="mycard">
        @foreach($inboxes as $inbox)
        <div class="bg-white shadow-md rounded-lg mb-4">
            <div class="p-4">
                <div class="flex flex-col lg:flex-row">
                    <span class="avatar rounded-full border border-gray-300 me-4 mb-2">
                        <img src="{{ url('img/profile_user.svg') }}" alt="Avatar" class="w-20 h-20 rounded-full" />
                    </span>
                    <div class="flex-grow flex items-center justify-between">
                        <div>
                            <h4 class="text-lg font-semibold">{{$inbox->clientUser->username}}</h4>
                        </div>
                        <div class="text-right">
                            <h5 class="text-lg font-medium">{{$inbox->type}}</h5>
                            <form action="{{ route('mail.'.$inbox->type, ['main_key' => $inbox->mainUser->id, 'client_key' => $inbox->clientUser->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400">Accept</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <script>
        $(document).ready(function () {
            $("#filter").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#mycard > div").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
</div>
@endsection
