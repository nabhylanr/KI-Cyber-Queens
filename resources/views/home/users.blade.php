@extends('master')
@include('sidebar')

@section('content')
<div class="bg-pink-100 min-h-screen py-10">
    <div class="container mx-auto bg-white p-8 rounded-lg shadow-md max-w-3xl mt-20" style="margin-right: 200px;">
        <h1 class="text-center text-xl text-pink-600 font-bold mb-10 leading-tight tracking-tight md:text-2xl">Users</h1>
        <form class="form-inline mb-6">
            <input class="form-control mr-sm-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-600 focus:border-pink-600 w-full p-2.5" 
                   id="filter" type="search" placeholder="Search" aria-label="Search" autocomplete="off" />
        </form>
        <table class="table table-hover table-bordered bg-white w-full rounded-lg">
            <thead class="bg-pink-600 text-white">
                <tr>
                    <th scope="col" class="p-4">Avatar</th>
                    <th scope="col" class="p-4">Username</th>
                    <th scope="col" class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usernames as $username)
                <tr class="border-b">
                    <td class="text-center p-4">
                        <img src="{{ url('img/profile1.svg') }}" alt="Avatar" style="width: 80px" />
                    </td>
                    <td class="p-4 text-gray-900">{{ $username->username }}</td>
                    <td class="text-center p-4">
                        <a href="/home/data/fullname/{{ $username->id }}" class="bg-pink-600 hover:bg-pink-500 text-white py-1 px-2 rounded text-sm">See Fullname</a>
                        <a href="/home/data/id_card/{{ $username->id }}" class="bg-pink-600 hover:bg-pink-500 text-white py-1 px-2 rounded text-sm">See ID Card</a>
                        <a href="/home/data/document/{{ $username->id }}" class="bg-pink-600 hover:bg-pink-500 text-white py-1 px-2 rounded text-sm">See Document</a>
                        <a href="/home/data/video/{{ $username->id }}" class="bg-pink-600 hover:bg-pink-500 text-white py-1 px-2 rounded text-sm">See Video</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function () {
            $("#filter").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#mytable tbody tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
</div>
@endsection