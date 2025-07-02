<x-app-layout>
  <div class="pt-24 px-4 sm:px-6 lg:px-8">
    <div class="max-w-xl mx-auto bg-white rounded-2xl shadow-xl p-8 text-center space-y-6">

      <h2 class="text-2xl font-bold text-green-600">✅ Mood recorded successfully!</h2>

      <p class="text-gray-600">Thank you for checking in.</p>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">

        <a href="{{ route('therapist.chat') }}" class="block p-4 bg-indigo-100 hover:bg-indigo-200 rounded-lg text-indigo-800 font-semibold">
          💬 Talk to a Therapist
        </a>

        <a href="" class="block p-4 bg-yellow-100 hover:bg-yellow-200 rounded-lg text-yellow-800 font-semibold">
          📝 Write a Journal Entry
        </a>

        <a href="{{ route('mood.history') }}" class="block p-4 bg-blue-100 hover:bg-blue-200 rounded-lg text-blue-800 font-semibold">
          📊 View Mood History
        </a>

        <a href="/breathing-exercise" class="block p-4 bg-teal-100 hover:bg-teal-200 rounded-lg text-teal-800 font-semibold">
          🌬️ Try a Breathing Exercise
        </a>

      </div>
    </div>
  </div>
</x-app-layout>
