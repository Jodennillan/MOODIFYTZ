<x-app-layout>
  <div class="pt-24 max-w-4xl mx-auto py-10 px-4">
    <h2 class="text-2xl font-bold text-indigo-700 mb-6">Your Mood History</h2>

    @foreach ($moods as $mood)
      <div class="bg-white border-l-4 border-indigo-300 mb-4 p-4 shadow rounded-md">
        <p class="text-lg">{{ $mood->mood }} <span class="text-sm text-gray-500">({{ ucfirst($mood->time_period) }})</span></p>
        @if ($mood->note)
          <p class="text-sm text-gray-600 mt-1">{{ $mood->note }}</p>
        @endif
        <p class="text-xs text-gray-400 mt-2">{{ $mood->created_at->diffForHumans() }}</p>
      </div>
    @endforeach
  </div>
</x-app-layout>
