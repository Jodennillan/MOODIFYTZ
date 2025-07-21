<x-app-layout>
  <div class="pt-24 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl p-6 sm:p-8 space-y-8">

      <div class="text-center">
        <h1 class="text-2xl font-bold text-emerald-700">Track Your Mood</h1>
        <p class="text-gray-600 mt-2">Record how you're feeling at different times of day</p>
      </div>

      <form method="POST" action="{{ route('mood.store') }}" class="space-y-8">
        @csrf

        <!-- Time Period Selection -->
        <div>
          <label class="block text-base font-medium text-gray-800 mb-3">Select Time Period</label>
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            @foreach($timePeriods as $key => $period)
              <div>
                <input type="radio" name="time_period" value="{{ $key }}" 
                       id="time-{{ $key }}" 
                       class="hidden peer" 
                       {{ $currentPeriod == $key ? 'checked' : '' }}>
                <label for="time-{{ $key }}" class="flex flex-col items-center p-3 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-emerald-300 transition-colors peer-checked:border-emerald-500 peer-checked:bg-emerald-50">
                  <span class="text-2xl">{{ $period['icon'] }}</span>
                  <span class="text-sm font-medium mt-1">{{ $period['label'] }}</span>
                </label>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Mood Selection -->
        <div>
          <label class="block text-base font-medium text-gray-800 mb-3">How are you feeling?</label>
          <div class="grid grid-cols-3 sm:grid-cols-6 gap-3">
            @foreach($moods as $key => $mood)
              <div>
                <input type="radio" name="mood" value="{{ $mood['emoji'] }} {{ $mood['label'] }}|{{ $key }}|{{ $mood['emoji'] }}" 
                       id="mood-{{ $key }}"
                       class="hidden peer" 
                       required>
                <label for="mood-{{ $key }}" class="flex flex-col items-center p-3 rounded-xl cursor-pointer border border-gray-200 hover:shadow-md transition-all peer-checked:ring-2 peer-checked:ring-emerald-500 peer-checked:bg-emerald-50 {{ $mood['color'] }}">
                  <span class="text-3xl mb-1">{{ $mood['emoji'] }}</span>
                  <span class="text-xs text-center">{{ $mood['label'] }}</span>
                </label>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Intensity Scale -->
        <div>
          <label class="block text-base font-medium text-gray-800 mb-3">
            Intensity: <span id="intensity-label" class="text-emerald-600 font-semibold">Moderate</span>
          </label>
          <div class="flex items-center space-x-3">
            <span class="text-sm text-gray-500">Low</span>
            <input type="range" name="intensity" min="1" max="10" value="5" 
                   class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-emerald-600"
                   id="intensity-slider">
            <span class="text-sm text-gray-500">High</span>
          </div>
          <div class="flex justify-between mt-1 px-1">
            @for($i = 1; $i <= 10; $i++)
              <div class="w-3 h-3 rounded-full {{ $i <= 3 ? 'bg-green-500' : ($i <= 7 ? 'bg-yellow-500' : 'bg-red-500') }}"></div>
            @endfor
          </div>
        </div>

        <!-- Mood Triggers -->
        <div>
          <label class="block text-base font-medium text-gray-800 mb-3">What's influencing your mood? (Optional)</label>
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            @foreach($triggers as $key => $trigger)
              <div>
                <input type="checkbox" name="triggers[]" value="{{ $key }}" 
                       id="trigger-{{ $key }}"
                       class="hidden peer">
                <label for="trigger-{{ $key }}" class="flex items-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-emerald-500 peer-checked:bg-emerald-50">
                  <span class="text-sm">{{ $trigger }}</span>
                </label>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Journal Note -->
        <div>
          <label for="note" class="block text-base font-medium text-gray-800 mb-2">Journal Note (Optional)</label>
          <textarea name="note" rows="3" placeholder="What's on your mind?"
                    class="w-full border border-gray-300 p-3 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500"></textarea>
        </div>

        <!-- Entry Date -->
        <div>
          <label class="block text-base font-medium text-gray-800 mb-2">Entry Date</label>
          <input type="date" name="entry_date" 
                 class="w-full border border-gray-300 p-3 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" 
                 value="{{ now()->toDateString() }}" required>
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
          <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-xl transition duration-300 ease-in-out transform hover:scale-[1.02]">
            Save Mood Entry
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Update intensity label
    const slider = document.getElementById('intensity-slider');
    const label = document.getElementById('intensity-label');
    
    // Set initial value
    updateIntensityLabel(slider.value);
    
    slider.addEventListener('input', () => {
      updateIntensityLabel(slider.value);
    });
    
    function updateIntensityLabel(value) {
      if(value <= 3) label.textContent = 'Mild';
      else if(value <= 6) label.textContent = 'Moderate';
      else if(value <= 8) label.textContent = 'Strong';
      else label.textContent = 'Intense';
    }
  </script>
</x-app-layout>