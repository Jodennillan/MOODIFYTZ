<x-app-layout>
  <div class="pt-24 px-4 sm:px-6 lg:px-8"> <!-- Pushes content below navbar -->
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl p-8 sm:p-10 space-y-8">

      <h2 class="text-3xl font-extrabold text-indigo-700 text-center">{{ $prompt }}</h2>

      <form method="POST" action="{{ route('mood.store') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="time_period" value="{{ $timePeriod }}">

        <!-- Mood Selection -->
        <div>
          <label class="block text-base font-semibold text-gray-700 mb-2">How do you feel right now?</label>
          <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
            @foreach(['😊 Happy', '😟 Anxious', '😢 Sad', '😠 Angry', '😴 Tired', '😐 Okay'] as $mood)
              <label class="flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-lg shadow-sm cursor-pointer hover:border-indigo-400 transition">
                <input type="radio" name="mood" value="{{ $mood }}" required>
                <span class="text-base">{{ $mood }}</span>
              </label>
            @endforeach
          </div>
        </div>

        <!-- Intensity -->
        <div>
          <label class="block text-base font-semibold text-gray-700 mb-2">How intense is this feeling?</label>
          <select name="intensity" class="w-full border border-gray-300 p-3 rounded-lg focus:ring-indigo-500">
            <option value="Low">🟢 Low</option>
            <option value="Moderate">🟡 Moderate</option>
            <option value="High">🔴 High</option>
          </select>
        </div>

        <!-- Optional Note -->
        <div>
          <label for="note" class="block text-base font-semibold text-gray-700 mb-2">Add a note (optional)</label>
          <textarea name="note" rows="3" class="w-full border border-gray-300 p-3 rounded-lg shadow-sm resize-none focus:ring-indigo-500"></textarea>
        </div>

        <!-- Entry Date -->
        <div>
          <label class="block text-base font-semibold text-gray-700 mb-2">Entry Date</label>
          <input type="date" name="entry_date" class="w-full border border-gray-300 p-3 rounded-lg focus:ring-indigo-500" value="{{ now()->toDateString() }}" required>
        </div>

        <!-- Submit -->
        <div class="text-center">
          <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-3 rounded-full transition">
            Submit Mood
          </button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
