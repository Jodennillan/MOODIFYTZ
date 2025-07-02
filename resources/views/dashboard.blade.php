<x-app-layout>
  <div class="min-h-screen py-16 px-6 fixed">
    <div class="max-w-7xl mx-auto">
      
      <!-- Welcome Heading -->
      <div class="mb-8 text-center">
       <h1 class="text-3xl font-bold text-indigo-800 font-poppins">Welcome to Your Dashboard</h1>
      </div>

      <!-- Dashboard Feature Cards -->
      <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4 justify-items-center">
        
        <!-- Mood Tracker -->
        <a href="{{ route('mood.create') }}" class="group bg-white/90 border border-indigo-100 shadow-sm hover:shadow-md transition-all p-6 rounded-lg flex flex-col items-center justify-center text-center w-full aspect-square">
          <img src="https://cdn-icons-png.flaticon.com/512/3464/3464497.png"
               class="w-12 h-12 mb-4 group-hover:scale-110 transition-transform duration-300"
               alt="Mood Tracker" />
          <h3 class="text-base font-semibold text-indigo-700">Mood Tracker</h3>
          <p class="text-xs text-gray-500 mt-1">Log your emotions & monitor changes.</p>
        </a>

        <!-- Self Assessment -->
        <a href="{{ route('assessment.create') }}" class="group bg-white/90 border border-blue-100 shadow-sm hover:shadow-md transition-all p-6 rounded-lg flex flex-col items-center justify-center text-center w-full aspect-square">
          <img src="https://cdn-icons-png.flaticon.com/512/4341/4341025.png"
               class="w-12 h-12 mb-4 group-hover:scale-110 transition-transform duration-300"
               alt="Self Assessment" />
          <h3 class="text-base font-semibold text-blue-600">Self Assessment</h3>
          <p class="text-xs text-gray-500 mt-1">Personalized mental wellness checkups.</p>
        </a>

        <!-- Anonymous Support -->
        <a href="{{ route('peer.group') }}" class="group bg-white/90 border border-green-100 shadow-sm hover:shadow-md transition-all p-6 rounded-lg flex flex-col items-center justify-center text-center w-full aspect-square">
          <img src="https://cdn-icons-png.flaticon.com/512/456/456212.png"
               class="w-12 h-12 mb-4 group-hover:scale-110 transition-transform duration-300"
               alt="Anonymous Support" />
          <h3 class="text-base font-semibold text-green-600">Anonymous Support</h3>
          <p class="text-xs text-gray-500 mt-1">Share safely in private support groups.</p>
        </a>

        <!-- Professional Help -->
        <a href="{{ route('therapist.chat') }}" class="group bg-white/90 border border-purple-100 shadow-sm hover:shadow-md transition-all p-6 rounded-lg flex flex-col items-center justify-center text-center w-full aspect-square">
          <img src="https://cdn-icons-png.flaticon.com/512/2922/2922561.png"
               class="w-12 h-12 mb-4 group-hover:scale-110 transition-transform duration-300"
               alt="Therapist Access" />
          <h3 class="text-base font-semibold text-purple-600">Professional Help</h3>
          <p class="text-xs text-gray-500 mt-1">Connect with certified mental health experts.</p>
        </a>

      </div>
    </div>
  </div>
</x-app-layout>
