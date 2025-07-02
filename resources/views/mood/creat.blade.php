<x-app-layout>
  <div class="max-w-2xl mx-auto py-12 px-6">
    <h2 class="text-3xl font-extrabold text-indigo-800 mb-6 text-center">🧘 Mood Check-In</h2>

    @if(session('success'))
      <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" action="{{ route('mood.store') }}" class="space-y-8 bg-white p-6 rounded-xl shadow">
      @csrf

      <!-- Mood Selection -->
      <div>
        <label class="block text-lg font-semibold text-indigo-700 mb-3">How are you feeling today?</label>
        <div class="grid grid-cols-3 gap-4">
          @foreach(['Happy' => '😊', 'Sad' => '😢', 'Angry' => '😠', 'Anxious' => '😟', 'Excited' => '🤩', 'Tired' => '😴'] as $label => $emoji)
            <label class="flex flex-col items-center p-3 rounded-lg border border-gray-200 hover:border-indigo-500 cursor-pointer transition">
              <input type="radio" name="mood" value="{{ $label }}" class="sr-only" required>
              <span class="text-3xl">{{ $emoji }}</span>
              <span class="text-sm mt-2 text-gray-700">{{ $label }}</span>
            </label>
          @endforeach
        </div>
      </div>

      <!-- Intensity -->
      <div>
        <label class="block text-lg font-semibold text-indigo-700 mb-3">How intense is this feeling?</label>
        <select name="intensity" class="w-full p-3 border rounded focus:ring-indigo-500">
          <option value="Low">🟢 Low</option>
          <option value="Moderate">🟡 Moderate</option>
          <option value="High">🔴 High</option>
        </select>
      </div>

      <!-- Reason -->
      <div>
        <label class="block text-lg font-semibold text-indigo-700 mb-3">Would you like to share why?</label>
        <textarea name="reason" rows="3" class="w-full p-3 border rounded resize-none" placeholder="Optional..."></textarea>
      </div>

      <!-- Date -->
      <div>
        <label class="block text-lg font-semibold text-indigo-700 mb-3">Entry Date</label>
        <input type="date" name="entry_date" class="w-full p-3 border rounded" value="{{ now()->toDateString() }}" required>
      </div>

      <!-- Submit -->
      <div class="text-right">
        <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-indigo-700 transition">
          Save Mood
        </button>
      </div>
    </form>
  </div>
</x-app-layout>
