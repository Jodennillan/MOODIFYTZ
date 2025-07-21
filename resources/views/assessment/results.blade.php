<x-app-layout>
  <div class="pt-24 max-w-4xl mx-auto py-12 px-6">
    <div class="bg-green-50 rounded-2xl p-8 shadow-lg">
      <div class="text-center mb-10">
        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
          <span class="text-4xl">🌿</span>
        </div>
        <h1 class="text-3xl font-bold text-green-800 mb-3">Your Mental Wellness Insights</h1>
        <p class="text-green-600">Based on your assessment on {{ $assessment->created_at->format('M d, Y') }}</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        <div class="bg-white p-6 rounded-xl border border-green-200">
          <h3 class="text-xl font-semibold text-green-700 mb-4 flex items-center">
            <span class="bg-green-100 p-2 rounded-lg mr-3">😌</span> Mood Summary
          </h3>
          <p class="text-green-800">
            You reported feeling <span class="font-semibold">{{ $assessment->answers['emotional_state']['mood'] }}</span> 
            with anxiety at level <span class="font-semibold">{{ $assessment->answers['anxiety_level'] }}/5</span>
          </p>
        </div>

        <div class="bg-white p-6 rounded-xl border border-green-200">
          <h3 class="text-xl font-semibold text-green-700 mb-4 flex items-center">
            <span class="bg-green-100 p-2 rounded-lg mr-3">💡</span> Primary Stressors
          </h3>
          <ul class="list-disc pl-5 text-green-800">
            @foreach($assessment->answers['stress_factors'] as $factor)
              <li>{{ $factor }}</li>
            @endforeach
          </ul>
        </div>

        <div class="bg-white p-6 rounded-xl border border-green-200">
          <h3 class="text-xl font-semibold text-green-700 mb-4 flex items-center">
            <span class="bg-green-100 p-2 rounded-lg mr-3">🛡️</span> Coping Strategies
          </h3>
          <ul class="list-disc pl-5 text-green-800">
            @foreach($assessment->answers['coping_mechanisms'] as $method)
              <li>{{ $method }}</li>
            @endforeach
          </ul>
        </div>

        <div class="bg-white p-6 rounded-xl border border-green-200">
          <h3 class="text-xl font-semibold text-green-700 mb-4 flex items-center">
            <span class="bg-green-100 p-2 rounded-lg mr-3">🎯</span> Wellness Goal
          </h3>
          <p class="text-green-800 font-semibold">{{ $assessment->answers['wellness_goal'] }}</p>
        </div>
      </div>

      <div class="bg-green-100 rounded-xl p-6 mb-10">
        <h2 class="text-2xl font-bold text-green-800 mb-6 text-center">Personalized Recommendations</h2>
        <div class="space-y-4">
          @foreach($assessment->advice as $tip)
            <div class="flex items-start bg-white p-4 rounded-lg">
              <span class="text-green-500 mr-3 mt-1">✓</span>
              <p class="text-green-800">{{ $tip }}</p>
            </div>
          @endforeach
        </div>
      </div>

      <div class="bg-white rounded-xl p-6 border border-green-200">
        <h3 class="text-xl font-semibold text-green-700 mb-4 text-center">Your Positive Action Plan</h3>
        <div class="text-center p-4 bg-green-50 rounded-lg">
          <p class="text-green-800 text-lg font-medium">"{{ $assessment->answers['positive_action'] }}"</p>
          <p class="text-green-600 mt-3">Commit to doing this within the next 24 hours</p>
        </div>
        <div class="mt-6 text-center">
          <a href="{{ route('assessment.download', $assessment) }}" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition font-medium">
            Download Action Plan PDF
          </a>
          <p class="mt-4 text-green-600">Retake assessment in 2 weeks to track progress</p>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>