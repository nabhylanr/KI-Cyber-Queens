@extends('master')

@section('content')
<section class="bg-pink-100">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-pink-600 md:text-2xl">
                  Login
              </h1>
              <form action="/login" method="post" enctype="multipart/form-data" class="space-y-4 md:space-y-6">
                  @csrf
                  
                  <div>
                      <label for="username" class="block mb-2 text-sm font-medium text-pink-600">Username</label>
                      <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Username" required="">
                  </div>

                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-pink-600">Password</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 0" required="">
                  </div>

                  <button type="submit" class="w-full text-white bg-pink-600 hover:bg-pink-500 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login</button>
              </form>

              <p class="text-sm font-light text-pink-600">
                  Don't have an account? <a href="/register" class="font-medium text-primary-600 hover:underline">Create new</a>
              </p>
          </div>
      </div>
  </div>
</section>
@endsection