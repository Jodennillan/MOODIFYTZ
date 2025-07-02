<aside  class="w-64 h-screen fixed left-0 top-0 pt-16 z-30 bg-gradient-to-b from-indigo-500/90 to-indigo-100/70 text-white shadow-lg">
  <nav class="px-6 py-4 space-y-6 text-sm font-medium text-gray-800">

    <!-- Dashboard -->
    <div class="flex items-center gap-3 px-4 py-2 rounded hover:bg-indigo-50 transition">
      <img src="https://cdn-icons-png.flaticon.com/512/1828/1828765.png" class="w-5 h-5" alt="Dashboard">
      <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
      </x-nav-link>
    </div>

    <!-- Assessments -->
    <div x-data="{ open: false }" class="space-y-1">
      <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-2 rounded hover:bg-indigo-50 transition">
        <span class="flex items-center gap-3">
          <img src="https://cdn-icons-png.flaticon.com/512/3251/3251866.png" class="w-5 h-5" alt="Assessments">
          <span class="strong-black">Assessments</span>
        </span>
        <svg :class="{'rotate-90': open}" class="w-4 h-4 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
      <div x-show="open" x-transition class="ml-8 space-y-1 text-gray-600">
        <a href="/assessment" class="block py-1 hover:text-indigo-600">Start Assessment</a>
        <a href="#" class="block py-1 hover:text-indigo-600">Assessment History</a>
      </div>
    </div>

    <!-- Mood Tracker -->
    <div x-data="{ open: false }" class="space-y-1">
      <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-2 rounded hover:bg-indigo-50 transition">
        <span class="flex items-center gap-3">
          <img src="https://cdn-icons-png.flaticon.com/512/3464/3464497.png" class="w-5 h-5" alt="Mood Tracker">
          <span>Mood Tracker</span>
        </span>
        <svg :class="{'rotate-90': open}" class="w-4 h-4 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
      <div x-show="open" x-transition class="ml-8 space-y-1 text-gray-600">
        <a href="/mood/create" class="block py-1 hover:text-indigo-600">Daily Check-Ins</a>
        <a href="#" class="block py-1 hover:text-indigo-600">Mood History</a>
      </div>
    </div>

    <!-- Community -->
    <div x-data="{ open: false }" class="space-y-1">
      <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-2 rounded hover:bg-indigo-50 transition">
        <span class="flex items-center gap-3">
          <img src="https://cdn-icons-png.flaticon.com/512/5610/5610944.png" class="w-5 h-5" alt="Community">
          <span>Community</span>
        </span>
        <svg :class="{'rotate-90': open}" class="w-4 h-4 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
      <div x-show="open" x-transition class="ml-8 space-y-1 text-gray-600">
        <a href="/forum" class="block py-1 hover:text-indigo-600">Forum</a>
       
        <a href="{{ route('therapist.chat') }}" class="block py-1 hover:text-indigo-600">Therapist chat</a>
        <a href="/ask-peer" class="block py-1 hover:text-indigo-600">Ask a Peer</a>
      </div>
    </div>

    <!-- Settings -->
    <a href="#" class="flex items-center gap-3 px-4 py-2 rounded hover:bg-indigo-50 transition">
      <img src="https://cdn-icons-png.flaticon.com/512/2099/2099058.png" class="w-5 h-5" alt="Settings">
      <span>Settings</span>
    </a>

  </nav>
</aside>
