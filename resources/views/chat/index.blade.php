<x-app-layout>
  <div class="pt-24 max-w-4xl mx-auto px-6">
    <h1 class="text-2xl font-bold text-indigo-800 mb-6">💬 Therapist Conversations</h1>

    @forelse ($therapists as $therapist)
      <a href="{{ route('chat.show', $therapist->id) }}" class="block bg-white hover:bg-indigo-50 border border-indigo-100 rounded-lg p-4 mb-4 shadow-sm transition">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-4">
            <img src="https://cdn-icons-png.flaticon.com/512/2922/2922561.png" class="w-10 h-10 rounded-full" alt="Therapist">
            <div>
              <h2 class="text-lg font-semibold text-gray-800">{{ $therapist->name }}</h2>
              <p class="text-sm text-gray-500">Click to view conversation</p>
            </div>
          </div>
          <div class="text-xs text-gray-400">
            🕒 {{ $therapist->lastMessage?->created_at->diffForHumans() ?? 'No messages yet' }}
          </div>
        </div>
      </a>
    @empty
      <p class="text-gray-600">No therapists available for chat right now.</p>
    @endforelse
  </div>
</x-app-layout>
