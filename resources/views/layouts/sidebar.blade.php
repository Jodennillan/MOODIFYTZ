<aside class="w-64 h-screen fixed left-0 top-0 pt-16 z-30 bg-gradient-to-b from-emerald-700 to-teal-900 text-white shadow-xl transition-all duration-300">
  <nav class="px-4 py-6 space-y-3 text-base font-medium">
    <!-- Dashboard -->
    <div class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-emerald-600/50 transition-all duration-200 group">
      <div class="bg-emerald-500/20 p-2 rounded-lg group-hover:bg-emerald-400/30 transition-colors">
        <img src="https://cdn-icons-png.flaticon.com/512/1828/1828765.png" class="w-5 h-5 filter brightness-0 invert" alt="Dashboard">
      </div>
      <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-emerald-50 group-hover:text-white">
        {{ __('Dashboard') }}
      </x-nav-link>
    </div>

    <!-- Assessments -->
    <div x-data="{ open: false }" class="space-y-1">
      <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 rounded-lg hover:bg-emerald-600/50 transition-all duration-200 group">
        <span class="flex items-center gap-3">
          <div class="bg-emerald-500/20 p-2 rounded-lg group-hover:bg-emerald-400/30 transition-colors">
            <img src="https://cdn-icons-png.flaticon.com/512/3251/3251866.png" class="w-5 h-5 filter brightness-0 invert" alt="Assessments">
          </div>
          <span class="text-emerald-50 group-hover:text-white">Assessments</span>
        </span>
        <svg :class="{'rotate-90 text-emerald-300': open}" class="w-4 h-4 text-emerald-400 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
      <div x-show="open" x-transition:enter="transition ease-out duration-200" 
           x-transition:enter-start="opacity-0 transform -translate-y-2" 
           x-transition:enter-end="opacity-100 transform translate-y-0"
           class="ml-12 space-y-1 pt-1 text-gray-300">
        <a href="/assessment" class="block py-2 pl-4 rounded-lg hover:bg-emerald-600/50 hover:text-white transition-colors">Start Assessment</a>
        
      </div>
    </div>

    <!-- Mood Tracker -->
    <div x-data="{ open: false }" class="space-y-1">
      <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 rounded-lg hover:bg-emerald-600/50 transition-all duration-200 group">
        <span class="flex items-center gap-3">
          <div class="bg-emerald-500/20 p-2 rounded-lg group-hover:bg-emerald-400/30 transition-colors">
            <img src="https://cdn-icons-png.flaticon.com/512/3464/3464497.png" class="w-5 h-5 filter brightness-0 invert" alt="Mood Tracker">
          </div>
          <span class="text-emerald-50 group-hover:text-white">Mood Tracker</span>
        </span>
        <svg :class="{'rotate-90 text-emerald-300': open}" class="w-4 h-4 text-emerald-400 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
      <div x-show="open" x-transition:enter="transition ease-out duration-200" 
           x-transition:enter-start="opacity-0 transform -translate-y-2" 
           x-transition:enter-end="opacity-100 transform translate-y-0"
           class="ml-12 space-y-1 pt-1 text-gray-300">
        <a href="/mood/create" class="block py-2 pl-4 rounded-lg hover:bg-emerald-600/50 hover:text-white transition-colors">Daily Check-Ins</a>
        <a href="/mood/history" class="block py-2 pl-4 rounded-lg hover:bg-emerald-600/50 hover:text-white transition-colors">Mood History</a>
      </div>
    </div>

    <div x-data="{ open: false }" class="space-y-1">
      <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 rounded-lg hover:bg-emerald-600/50 transition-all duration-200 group">
        <span class="flex items-center gap-3">
          <div class="bg-emerald-500/20 p-2 rounded-lg group-hover:bg-emerald-400/30 transition-colors">
            <img src="https://cdn-icons-png.flaticon.com/512/3464/3464497.png" class="w-5 h-5 filter brightness-0 invert" alt="Mood Tracker">
          </div>
          <span class="text-emerald-50 group-hover:text-white">Journals</span>
        </span>
        <svg :class="{'rotate-90 text-emerald-300': open}" class="w-4 h-4 text-emerald-400 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
      <div x-show="open" x-transition:enter="transition ease-out duration-200" 
           x-transition:enter-start="opacity-0 transform -translate-y-2" 
           x-transition:enter-end="opacity-100 transform translate-y-0"
           class="ml-12 space-y-1 pt-1 text-gray-300">
        <a href="{{route('journal.history')}}" class="block py-2 pl-4 rounded-lg hover:bg-emerald-600/50 hover:text-white transition-colors">My Journal</a>
        
      </div>
    </div>

    <!-- Community -->
    <div x-data="{ open: false }" class="space-y-1">
      <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 rounded-lg hover:bg-emerald-600/50 transition-all duration-200 group">
        <span class="flex items-center gap-3">
          <div class="bg-emerald-500/20 p-2 rounded-lg group-hover:bg-emerald-400/30 transition-colors">
            <img src="https://cdn-icons-png.flaticon.com/512/5610/5610944.png" class="w-5 h-5 filter brightness-0 invert" alt="Community">
          </div>
          <span class="text-emerald-50 group-hover:text-white">Community</span>
        </span>
        <svg :class="{'rotate-90 text-emerald-300': open}" class="w-4 h-4 text-emerald-400 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
      <div x-show="open" x-transition:enter="transition ease-out duration-200" 
           x-transition:enter-start="opacity-0 transform -translate-y-2" 
           x-transition:enter-end="opacity-100 transform translate-y-0"
           class="ml-12 space-y-1 pt-1 text-gray-300">
        <a href="/forum" class="block py-2 pl-4 rounded-lg hover:bg-emerald-600/50 hover:text-white transition-colors">Forum</a>
        <a href="{{ route('therapist.chat') }}" class="block py-2 pl-4 rounded-lg hover:bg-emerald-600/50 hover:text-white transition-colors">Therapist Chat</a>
        <a href="/ask-peer" class="block py-2 pl-4 rounded-lg hover:bg-emerald-600/50 hover:text-white transition-colors">Ask a Peer</a>
      </div>
    </div>

    <!-- Settings -->
    <div class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-emerald-600/50 transition-all duration-200 group">
      <div class="bg-emerald-500/20 p-2 rounded-lg group-hover:bg-emerald-400/30 transition-colors">
        <img src="https://cdn-icons-png.flaticon.com/512/2099/2099058.png" class="w-5 h-5 filter brightness-0 invert" alt="Settings">
      </div>
      <a href="#" class="text-emerald-50 group-hover:text-white">Settings</a>
    </div>

   
  </nav>
</aside>