<nav class="bg-white">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-200 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            @guest
            <a href="{{ url('/login') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-gray-900">Login</a>
            <a href="{{ url('/register') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-gray-900">Register</a>
            @endguest

            @auth
            @if(!is_null($aess) && count($aess) < 1)
            <a href="{{ url('/home/create') }}" class="rounded-md px-3 py-2 text-sm font-medium {{ Request::is('home/create') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-200 hover:text-gray-900' }}">Upload</a>
            @else
            <a href="{{ url('/home/edit') }}" class="rounded-md px-3 py-2 text-sm font-medium {{ Request::is('home/edit') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-200 hover:text-gray-900' }}">Update</a>
            @endif
            <a href="{{ url('/home') }}" class="rounded-md px-3 py-2 text-sm font-medium {{ Request::is('home') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-200 hover:text-gray-900' }}">Profile</a>
            <a href="{{ url('/logout') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-gray-900">Log Out</a>
            @endauth
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div class="sm:hidden" id="mobile-menu">
    <div class="space-y-1 px-2 pb-3 pt-2">
      @guest
      <a href="{{ url('/login') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-200 hover:text-gray-900">Login</a>
      <a href="{{ url('/register') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-200 hover:text-gray-900">Register</a>
      @endguest

      @auth
      @if(!is_null($aess) && count($aess) < 1)
      <a href="{{ url('/home/create') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ Request::is('home/create') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-200 hover:text-gray-900' }}">Upload</a>
      @else
      <a href="{{ url('/home/edit') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ Request::is('home/edit') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-200 hover:text-gray-900' }}">Update</a>
      @endif
      <a href="{{ url('/home') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ Request::is('home') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-200 hover:text-gray-900' }}">Profile</a>
      <a href="{{ url('/home/users') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ Request::is('home/users') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-200 hover:text-gray-900' }}">Users List</a>
      <a href="{{ url('/home/inbox') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ Request::is('home/inbox') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-200 hover:text-gray-900' }}">Inbox</a>
      <a href="{{ url('/logout') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-200 hover:text-gray-900">Log Out</a>
      @endauth
    </div>
  </div>
</nav>
