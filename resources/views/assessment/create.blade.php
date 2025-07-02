<x-app-layout>
  <div class="pt-24 max-w-3xl mx-auto py-12 px-6">
    <h2 class="text-3xl font-extrabold text-indigo-800 mb-6 text-center">🧠 Moodify Personal Assessment</h2>

    <!-- Progress Dots -->
    <div class="flex justify-center space-x-2 mb-8" id="progressDots">
      @foreach(['Emotions','Motivation','Identity','Digital Life','Spiritual','Goals','Reflection'] as $index => $label)
        <div class="w-4 h-4 rounded-full bg-indigo-200 transition-all duration-300"></div>
      @endforeach
    </div>

    <form method="POST" action="{{ route('assessment.store') }}" id="assessmentForm">
      @csrf

      <!-- Step 1 -->
      <div class="step">
        <h3 class="text-xl font-semibold text-indigo-700 mb-3">How are you feeling today?</h3>
        <div class="grid grid-cols-2 gap-4">
          <label><input type="radio" name="emotional_state[mood]" value="Happy" required> 😊 Happy</label>
          <label><input type="radio" name="emotional_state[mood]" value="Sad"> 😢 Sad</label>
          <label><input type="radio" name="emotional_state[mood]" value="Anxious"> 😟 Anxious</label>
          <label><input type="radio" name="emotional_state[mood]" value="Angry"> 😠 Angry</label>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="step hidden">
        <h3 class="text-xl font-semibold text-indigo-700 mb-3">Why did you come to Moodify today?</h3>
        <textarea name="motivation[reason]" class="w-full p-3 border rounded" required></textarea>
      </div>

      <!-- Step 3 -->
      <div class="step hidden">
        <h3 class="text-xl font-semibold text-indigo-700 mb-3">Tell us about yourself</h3>
        <input type="text" name="personal_identity[gender]" placeholder="Gender" class="w-full mb-3 p-2 border rounded" required>
        <input type="number" name="personal_identity[age]" placeholder="Age" class="w-full p-2 border rounded" required>
      </div>

      <!-- Step 4 -->
      <div class="step hidden">
        <h3 class="text-xl font-semibold text-indigo-700 mb-3">How do you feel after screen time?</h3>
        <select name="digital_wellbeing[feeling]" class="w-full p-2 border rounded" required>
          <option value="">Select</option>
          <option value="Inspired">😊 Inspired</option>
          <option value="Neutral">😐 Neutral</option>
          <option value="Insecure">😔 Insecure</option>
          <option value="Drained">😩 Drained</option>
        </select>
      </div>

      <!-- Step 5 -->
      <div class="step hidden">
        <h3 class="text-xl font-semibold text-indigo-700 mb-3">Do spiritual beliefs affect your wellbeing?</h3>
        <textarea name="spiritual_context[comment]" class="w-full p-3 border rounded"></textarea>
      </div>

      <!-- Step 6 -->
      <div class="step hidden">
        <h3 class="text-xl font-semibold text-indigo-700 mb-3">What's your main wellness goal?</h3>
        <select name="wellness_goals[main]" class="w-full p-2 border rounded" required>
          <option value="">Select</option>
          <option value="Reduce Anxiety">Reduce Anxiety</option>
          <option value="Sleep Better">Sleep Better</option>
          <option value="Improve Confidence">Improve Confidence</option>
          <option value="Stronger Relationships">Stronger Relationships</option>
        </select>
      </div>

      <!-- Step 7 -->
      <div class="step hidden">
        <h3 class="text-xl font-semibold text-indigo-700 mb-3">Any plans or habits you're working on?</h3>
        <textarea name="reflection_plan[summary]" class="w-full p-3 border rounded" required></textarea>
      </div>

      <!-- Navigation Buttons -->
      <div class="flex justify-between mt-8">
        <button type="button" id="prevBtn" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition">
          Back
        </button>
        <button type="button" id="nextBtn" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
          Next
        </button>
      </div>
    </form>
  </div>

  <script>
    const steps = document.querySelectorAll(".step");
    const nextBtn = document.getElementById("nextBtn");
    const prevBtn = document.getElementById("prevBtn");
    const dots = document.querySelectorAll("#progressDots div");
    const form = document.getElementById("assessmentForm");

    let currentStep = 0;

    function showStep(index) {
      steps.forEach((step, i) => {
        step.classList.toggle("hidden", i !== index);
        dots[i].classList = "w-4 h-4 rounded-full transition-all " + (i === index ? "bg-indigo-600" : "bg-indigo-200");
      });

      prevBtn.disabled = index === 0;
      nextBtn.textContent = index === steps.length - 1 ? "Submit" : "Next";
    }

    nextBtn.addEventListener("click", () => {
      if (currentStep === steps.length - 1) {
        form.submit();
      } else {
        currentStep++;
        showStep(currentStep);
      }
    });

    prevBtn.addEventListener("click", () => {
      if (currentStep > 0) {
        currentStep--;
        showStep(currentStep);
      }
    });

    showStep(currentStep);
  </script>

  <style>
    .hidden { display: none; }
  </style>
</x-app-layout>
