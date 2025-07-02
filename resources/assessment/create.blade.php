<x-app-layout>
<div class="max-w-4xl mx-auto py-12 px-4">
  <h2 class="text-3xl font-extrabold text-indigo-800 mb-6 text-center">🧠 Moodify Personal Assessment</h2>

  <!-- Progress Dots -->
  <div class="flex justify-center space-x-3 mb-10">
    @foreach(['Emotions','Motivation','Identity','Digital Life','Spiritual','Goals','Reflection'] as $index => $label)
      <div class="w-4 h-4 rounded-full transition-all duration-300"
           :class="step === {{ $index }} ? 'bg-indigo-600' : 'bg-indigo-200'">
      </div>
    @endforeach
  </div>

  <!-- Form -->
  <form method="POST" action="{{ route('assessment.store') }}" x-data="{ step: 0 }" @submit.prevent="step === 6 ? $el.submit() : step++">
    @csrf

    <!-- Step 1: Emotional Check-In -->
    <div x-show="step === 0" class="fade-in">
      <h3 class="text-xl font-bold text-indigo-700 mb-3">How are you feeling today?</h3>
      <div class="grid grid-cols-2 gap-4">
        <label><input type="radio" name="emotional_state[mood]" value="Happy" required> 😊 Happy</label>
        <label><input type="radio" name="emotional_state[mood]" value="Sad"> 😢 Sad</label>
        <label><input type="radio" name="emotional_state[mood]" value="Anxious"> 😟 Anxious</label>
        <label><input type="radio" name="emotional_state[mood]" value="Angry"> 😠 Angry</label>
      </div>
    </div>

    <!-- Step 2: Motivation -->
    <div x-show="step === 1" class="fade-in">
      <h3 class="text-xl font-bold text-indigo-700 mb-3">Why did you come to Moodify today?</h3>
      <textarea name="motivation[reason]" class="w-full p-3 border rounded" required></textarea>
    </div>

    <!-- Step 3: Personal Identity -->
    <div x-show="step === 2" class="fade-in">
      <h3 class="text-xl font-bold text-indigo-700 mb-3">Tell us about yourself</h3>
      <input type="text" name="personal_identity[gender]" placeholder="Gender" class="w-full mb-3 p-2 border rounded">
      <input type="text" name="personal_identity[age]" placeholder="Age" class="w-full p-2 border rounded">
    </div>

    <!-- Step 4: Digital Wellbeing -->
    <div x-show="step === 3" class="fade-in">
      <h3 class="text-xl font-bold text-indigo-700 mb-3">How do you feel after screen time?</h3>
      <select name="digital_wellbeing[feeling]" class="w-full p-2 border rounded">
        <option value="Inspired">😊 Inspired</option>
        <option value="Neutral">😐 Neutral</option>
        <option value="Insecure">😔 Insecure</option>
        <option value="Drained">😩 Drained</option>
      </select>
    </div>

    <!-- Step 5: Spiritual Context -->
    <div x-show="step === 4" class="fade-in">
      <h3 class="text-xl font-bold text-indigo-700 mb-3">Do spiritual beliefs affect your wellbeing?</h3>
      <textarea name="spiritual_context[comment]" class="w-full p-3 border rounded"></textarea>
    </div>

    <!-- Step 6: Wellness Goals -->
    <div x-show="step === 5" class="fade-in">
      <h3 class="text-xl font-bold text-indigo-700 mb-3">What's your main wellness goal?</h3>
      <select name="wellness_goals[main]" class="w-full p-2 border rounded">
        <option value="Reduce Anxiety">Reduce Anxiety</option>
        <option value="Sleep Better">Sleep Better</option>
        <option value="Improve Confidence">Improve Confidence</option>
        <option value="Stronger Relationships">Stronger Relationships</option>
      </select>
    </div>

    <!-- Step 7: Reflection & Plan -->
    <div x-show="step === 6" class="fade-in">
      <h3 class="text-xl font-bold text-indigo-700 mb-3">Any plans or habits you're working on?</h3>
      <textarea name="reflection_plan[summary]" class="w-full p-3 border rounded" required></textarea>
    </div>

    <!-- Buttons -->
    <div class="flex justify-between mt-8">
      <button type="button" @click="step > 0 ? step-- : null"
              class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition">
        Back
      </button>
      <button type="submit"
              class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
        <span x-show="step < 6">Next</span>
        <span x-show="step === 6">Submit</span>
      </button>
    </div>
  </form>
</div>

<style>
.fade-in {
  transition: all 0.4s ease-in-out;
  animation: fadeIn 0.4s ease-in-out;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to   { opacity: 1; transform: translateY(0); }
}
</style>
</x-app-layout>
