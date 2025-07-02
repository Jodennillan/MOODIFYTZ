<x-app-layout>
  <div class="pt-24 px-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold text-indigo-800 mb-6">📅 Mood History</h2>

    <div class="grid gap-4">
      @forelse ($moods as $mood)
        <div class="bg-white shadow rounded-lg p-4">
          <div class="flex justify-between items-center">
            <div class="text-xl">{{ $mood->mood }}</div>
            <span class="text-sm text-gray-500">{{ $mood->entry_date->format('M d, Y') }}</span>
          </div>
          <div class="text-sm mt-1">Intensity: <strong>{{ $mood->intensity }}</strong></div>
          @if($mood->note)
            <p class="mt-2 text-gray-600 text-sm italic">“{{ Str::limit($mood->note, 100) }}”</p>
          @endif
        </div>
      @empty
        <p class="text-gray-500">No mood records found yet.</p>
      @endforelse
    </div>
  </div>
</x-app-layout>
