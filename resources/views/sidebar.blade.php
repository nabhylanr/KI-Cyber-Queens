<div class="flex">
    <div class="fixed inset-y-0 left-0 z-30 w-64 bg-white shadow-lg transition-transform transform -translate-x-full sm:translate-x-0" id="sidebar">
      <div class="h-full flex flex-col">
        <div class="flex items-center justify-center h-22 border-b">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-20 w-auto" />
        </div>
        <nav class="flex-1 overflow-y-auto">
          <div class="flex flex-col space-y-1 px-2 py-4">
            @guest
            <a href="{{ url('/login') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-200">Login</a>
            <a href="{{ url('/register') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-200">Register</a>
            @endguest
  
            @auth
            @if(!is_null($aess) && count($aess) < 1)
            <a href="{{ url('/home/create') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ Request::is('home/create') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-200' }}">Upload</a>
            @else
            <a href="{{ url('/home/edit') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ Request::is('home/edit') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-200' }}">Update</a>
            @endif
            <a href="{{ url('/home/inbox') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ Request::is('home/inbox') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-200' }}">Inbox</a>
            <a href="{{ url('/home/users') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ Request::is('home/users') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-200' }}">Users List</a>
            <a href="{{ url('/home') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ Request::is('home') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-200' }}">Profile</a>            
            <a href="{{ url('/logout') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-200">Log Out</a>
            @endauth
          </div>
        </nav>
      </div>
    </div> 
  </div>
  
  <script>
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
  
    toggleSidebar.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
    });
  </script>
  