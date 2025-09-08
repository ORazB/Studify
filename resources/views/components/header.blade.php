<header class="sticky top-0 bg-gray-900 text-white px-8 py-4 shadow-md">
  <div class="flex items-center justify-between mx-auto">
    <h1 class="text-2xl font-bold">Studify</h1>

    <div class="flex items-center gap-4 cursor-pointer">
      <img 
        src="/images/profile.jpg" 
        alt="Profile picture" 
        class="w-10 h-10 rounded-xl object-cover"
      >
      <div class="flex flex-col items-center">
        @if (session()->has('username'))
          <p class="text-base font-semibold">{{ session('username') }}</p>
        @else
          <p class="text-base">Guest</p>
        @endif
        <p class="text-sm text-gray-300">Admin</p>
      </div>
    </div>
  </div>
</header>