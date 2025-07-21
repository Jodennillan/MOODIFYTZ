<x-app-layout>
  <div class="pt-24 max-w-3xl mx-auto py-12 px-6">
    <div class="bg-green-50 rounded-2xl p-8 shadow-lg">
      <h2 class="text-3xl font-extrabold text-green-800 mb-6 text-center">🌿 MindfulWell Assessment</h2>
      <p class="text-green-700 text-center mb-8">Complete this brief assessment to receive personalized mental health insights</p>

      <!-- Progress Bar -->
      <div class="w-full bg-green-200 rounded-full h-3 mb-8">
        <div id="progressBar" class="bg-green-600 h-3 rounded-full transition-all duration-300" style="width: 14%"></div>
      </div>

      <form method="POST" action="{{ route('assessment.store') }}" id="assessmentForm">
        @csrf

        <!-- Step 1: Emotions -->
        <div class="step">
          <h3 class="text-xl font-semibold text-green-700 mb-4">How are you feeling right now?</h3>
          <div class="grid grid-cols-2 gap-4">
            <label class="flex items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="radio" name="emotional_state[mood]" value="Calm" required class="mr-3 h-5 w-5 text-green-600">
              <span class="text-lg">😌 Calm</span>
            </label>
            <label class="flex items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="radio" name="emotional_state[mood]" value="Anxious" class="mr-3 h-5 w-5 text-green-600">
              <span class="text-lg">😟 Anxious</span>
            </label>
            <label class="flex items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="radio" name="emotional_state[mood]" value="Overwhelmed" class="mr-3 h-5 w-5 text-green-600">
              <span class="text-lg">😵 Overwhelmed</span>
            </label>
            <label class="flex items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="radio" name="emotional_state[mood]" value="Fatigued" class="mr-3 h-5 w-5 text-green-600">
              <span class="text-lg">😩 Fatigued</span>
            </label>
          </div>
          <div id="step1-error" class="text-red-500 mt-3 hidden">Please select your current mood.</div>
        </div>

        <!-- Step 2: Stress Factors -->
        <div class="step hidden">
          <h3 class="text-xl font-semibold text-green-700 mb-4">What's causing you stress recently? (Select all that apply)</h3>
          <div class="grid grid-cols-2 gap-4">
            <label class="flex items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="checkbox" name="stress_factors[]" value="Work pressure" class="mr-3 h-5 w-5 text-green-600">
              <span>💼 Work pressure</span>
            </label>
            <label class="flex items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="checkbox" name="stress_factors[]" value="Relationships" class="mr-3 h-5 w-5 text-green-600">
              <span>💞 Relationships</span>
            </label>
            <label class="flex items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="checkbox" name="stress_factors[]" value="Financial worries" class="mr-3 h-5 w-5 text-green-600">
              <span>💰 Financial worries</span>
            </label>
            <label class="flex items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="checkbox" name="stress_factors[]" value="Health concerns" class="mr-3 h-5 w-5 text-green-600">
              <span>🩺 Health concerns</span>
            </label>
            <label class="flex items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="checkbox" name="stress_factors[]" value="Loneliness" class="mr-3 h-5 w-5 text-green-600">
              <span>👤 Loneliness</span>
            </label>
            <label class="flex items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="checkbox" name="stress_factors[]" value="Uncertainty" class="mr-3 h-5 w-5 text-green-600">
              <span>❓ Uncertainty</span>
            </label>
          </div>
          <div id="step2-error" class="text-red-500 mt-3 hidden">Please select at least one stress factor.</div>
        </div>

        <!-- Step 3: Anxiety Level -->
        <div class="step hidden">
          <h3 class="text-xl font-semibold text-green-700 mb-4">How would you rate your anxiety level today?</h3>
          <div class="grid grid-cols-5 gap-2 mb-6">
            <label class="flex flex-col items-center p-3 border border-green-300 rounded-lg hover:bg-green-100 cursor-pointer transition">
              <input type="radio" name="anxiety_level" value="1" required class="mb-2 h-5 w-5 text-green-600">
              <span>1</span>
              <span class="text-xs mt-1 text-green-600">Calm</span>
            </label>
            <label class="flex flex-col items-center p-3 border border-green-300 rounded-lg hover:bg-green-100 cursor-pointer transition">
              <input type="radio" name="anxiety_level" value="2" class="mb-2 h-5 w-5 text-green-600">
              <span>2</span>
            </label>
            <label class="flex flex-col items-center p-3 border border-green-300 rounded-lg hover:bg-green-100 cursor-pointer transition">
              <input type="radio" name="anxiety_level" value="3" class="mb-2 h-5 w-5 text-green-600">
              <span>3</span>
              <span class="text-xs mt-1 text-green-600">Moderate</span>
            </label>
            <label class="flex flex-col items-center p-3 border border-green-300 rounded-lg hover:bg-green-100 cursor-pointer transition">
              <input type="radio" name="anxiety_level" value="4" class="mb-2 h-5 w-5 text-green-600">
              <span>4</span>
            </label>
            <label class="flex flex-col items-center p-3 border border-green-300 rounded-lg hover:bg-green-100 cursor-pointer transition">
              <input type="radio" name="anxiety_level" value="5" class="mb-2 h-5 w-5 text-green-600">
              <span>5</span>
              <span class="text-xs mt-1 text-green-600">High</span>
            </label>
          </div>
          <div class="flex justify-between text-green-600 text-sm px-1">
            <span>Minimal</span>
            <span>Severe</span>
          </div>
          <div id="step3-error" class="text-red-500 mt-3 hidden">Please rate your anxiety level.</div>
        </div>

        <!-- Step 4: Coping Mechanisms -->
        <div class="step hidden">
          <h3 class="text-xl font-semibold text-green-700 mb-4">What helps you cope with stress? (Select all that apply)</h3>
          <div class="grid grid-cols-2 gap-4">
            <label class="flex items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="checkbox" name="coping_mechanisms[]" value="Exercise" class="mr-3 h-5 w-5 text-green-600">
              <span>🚶 Exercise</span>
            </label>
            <label class="flex items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="checkbox" name="coping_mechanisms[]" value="Meditation" class="mr-3 h-5 w-5 text-green-600">
              <span>🧘 Meditation</span>
            </label>
            <label class="flex items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="checkbox" name="coping_mechanisms[]" value="Social support" class="mr-3 h-5 w-5 text-green-600">
              <span>👥 Social support</span>
            </label>
            <label class="flex items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="checkbox" name="coping_mechanisms[]" value="Creative outlets" class="mr-3 h-5 w-5 text-green-600">
              <span>🎨 Creative outlets</span>
            </label>
            <label class="flex items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="checkbox" name="coping_mechanisms[]" value="Professional help" class="mr-3 h-5 w-5 text-green-600">
              <span>🩺 Professional help</span>
            </label>
            <label class="flex items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="checkbox" name="coping_mechanisms[]" value="Nature" class="mr-3 h-5 w-5 text-green-600">
              <span>🌳 Nature</span>
            </label>
          </div>
          <div id="step4-error" class="text-red-500 mt-3 hidden">Please select at least one coping mechanism.</div>
        </div>

        <!-- Step 5: Sleep Quality -->
        <div class="step hidden">
          <h3 class="text-xl font-semibold text-green-700 mb-4">How was your sleep quality last night?</h3>
          <div class="grid grid-cols-4 gap-4">
            <label class="flex flex-col items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="radio" name="sleep_quality" value="Restful" required class="mb-2 h-5 w-5 text-green-600">
              <span>😴 Restful</span>
            </label>
            <label class="flex flex-col items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="radio" name="sleep_quality" value="Interrupted" class="mb-2 h-5 w-5 text-green-600">
              <span>🔄 Interrupted</span>
            </label>
            <label class="flex flex-col items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="radio" name="sleep_quality" value="Insufficient" class="mb-2 h-5 w-5 text-green-600">
              <span>⏱️ Insufficient</span>
            </label>
            <label class="flex flex-col items-center p-4 border border-green-300 rounded-xl hover:bg-green-100 cursor-pointer transition">
              <input type="radio" name="sleep_quality" value="Restless" class="mb-2 h-5 w-5 text-green-600">
              <span>😣 Restless</span>
            </label>
          </div>
          <div id="step5-error" class="text-red-500 mt-3 hidden">Please select your sleep quality.</div>
        </div>

        <!-- Step 6: Wellness Goals -->
        <div class="step hidden">
          <h3 class="text-xl font-semibold text-green-700 mb-4">What's your primary wellness goal?</h3>
          <select name="wellness_goal" class="w-full p-3 border border-green-300 rounded-lg text-green-700" required>
            <option value="">Select your main goal</option>
            <option value="Reduce stress">🍃 Reduce stress</option>
            <option value="Improve mood">😊 Improve mood</option>
            <option value="Better sleep">🌙 Better sleep</option>
            <option value="Increase focus">🎯 Increase focus</option>
            <option value="Build resilience">🛡️ Build resilience</option>
            <option value="Enhance relationships">💞 Enhance relationships</option>
          </select>
          <div id="step6-error" class="text-red-500 mt-3 hidden">Please select your wellness goal.</div>
        </div>

        <!-- Step 7: Final Reflection -->
        <div class="step hidden">
          <h3 class="text-xl font-semibold text-green-700 mb-4">What's one positive thing you can do for yourself today?</h3>
          <textarea name="positive_action" class="w-full p-4 border border-green-300 rounded-lg" rows="3" placeholder="Example: Take a 10-minute walk, call a friend, practice deep breathing..." required></textarea>
          <div id="step7-error" class="text-red-500 mt-3 hidden">Please share one positive action.</div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between mt-10">
          <button type="button" id="prevBtn" class="bg-green-200 text-green-800 px-5 py-3 rounded-lg hover:bg-green-300 transition font-medium">
            ← Back
          </button>
          <button type="button" id="nextBtn" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition font-medium">
            Continue →
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const steps = document.querySelectorAll(".step");
    const nextBtn = document.getElementById("nextBtn");
    const prevBtn = document.getElementById("prevBtn");
    const form = document.getElementById("assessmentForm");
    let currentStep = 0;
    const stepTitles = [
      "Current Emotions",
      "Stress Factors",
      "Anxiety Level",
      "Coping Strategies",
      "Sleep Quality",
      "Wellness Goals",
      "Positive Action"
    ];

    function showStep(index) {
      steps.forEach((step, i) => {
        step.classList.toggle("hidden", i !== index);
      });
      
      updateProgressBar();
      updateButtonLabels();
      updateDocumentTitle(index);
    }

    function updateDocumentTitle(stepIndex) {
      document.title = `Step ${stepIndex+1}/7: ${stepTitles[stepIndex]} | MindfulWell`;
    }

    function updateProgressBar() {
      const progress = ((currentStep + 1) / steps.length) * 100;
      document.getElementById('progressBar').style.width = `${progress}%`;
    }

    function updateButtonLabels() {
      prevBtn.textContent = currentStep === 0 ? "" : `← Back`;
      prevBtn.classList.toggle("invisible", currentStep === 0);
      
      nextBtn.textContent = currentStep === steps.length - 1 
        ? "Get Insights →" 
        : "Continue →";
    }

    function validateStep() {
      const step = steps[currentStep];
      let isValid = true;
      
      // Reset errors
      const errorElement = step.querySelector('.text-red-500');
      if (errorElement) errorElement.classList.add('hidden');
      
      // Special validation for step 2 and 4 (checkboxes)
      if (currentStep === 1 || currentStep === 3) {
        const checkboxes = step.querySelectorAll('input[type="checkbox"]');
        const checked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        
        if (!checked) {
          isValid = false;
          step.querySelector(`#step${currentStep+1}-error`).classList.remove('hidden');
        }
      } 
      // Validate other steps
      else {
        const requiredInputs = step.querySelectorAll('[required]');
        requiredInputs.forEach(input => {
          if (!input.value) {
            isValid = false;
            input.classList.add('border-red-500');
            const errorId = `step${currentStep+1}-error`;
            const errorElement = document.getElementById(errorId);
            if (errorElement) errorElement.classList.remove('hidden');
          } else {
            input.classList.remove('border-red-500');
          }
        });
      }
      
      return isValid;
    }

    nextBtn.addEventListener("click", () => {
      if (!validateStep()) return;
      
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

    // Initialize
    showStep(currentStep);
  </script>

  <style>
    .hidden { display: none; }
    .border-red-500 { border-color: #ef4444; }
    .text-red-500 { color: #ef4444; }
    input:focus, textarea:focus, select:focus {
      outline: 2px solid #16a34a;
      outline-offset: 2px;
    }
    label:hover {
      background-color: #f0fdf4;
    }
  </style>
</x-app-layout>