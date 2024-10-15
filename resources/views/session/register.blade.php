@extends('master')

@section('content')
<section class="bg-pink-100">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-pink-600 md:text-2xl">
                  Create an account
              </h1>
              <form class="space-y-4 md:space-y-6" action="/register" method="post" enctype="multipart/form-data">
                  @csrf

                  <div>
                      <label for="username" class="block mb-2 text-sm font-medium text-pink-600">Username</label>
                      <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Username" required="">
                      @error('username')
                      <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                      @enderror
                  </div>

                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-pink-600">Email</label>
                      <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="name@gmail.com" required="">
                      @error('email')
                      <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                      @enderror
                  </div>

                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-pink-600">Password</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                      @error('password')
                      <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                      @enderror
                  </div>

                  <div>
                      <label for="confirm-password" class="block mb-2 text-sm font-medium text-pink-600">Confirm password</label>
                      <input type="password" name="confirm-password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                  </div>

                  <button type="submit" class="w-full text-white bg-pink-600 hover:bg-pink-500 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create an account</button>

                  <p class="text-sm font-light text-pink-600">
                      Already have an account? <a href="/login" class="font-medium text-primary-600 hover:underline">Login here</a>
                  </p>
              </form>
          </div>
      </div>
  </div>
</section>
@endsection
