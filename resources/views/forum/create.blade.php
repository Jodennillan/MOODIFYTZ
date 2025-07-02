<x-app-layout>
  <div class="pt-24 max-w-3xl mx-auto py-12 px-6">
    
    <!-- Page Header -->
    <h1 class="text-3xl font-extrabold text-indigo-800 mb-8">✍️ Start a New Discussion</h1>

    <!-- Validation Errors -->
    @if ($errors->any())
      <div class="mb-4 text-red-600 text-sm">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Post Form -->
    <form method="POST" action="{{ route('forum.store') }}" class="space-y-6">
      @csrf

      <!-- Title -->
      <div>
        <label for="title" class="block font-medium text-gray-700 mb-1">Discussion Title</label>
        <input type="text" name="title" id="title" required
               class="w-full px-4 py-2 border border-indigo-200 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
               placeholder="e.g. Struggling with anxiety at night...">
      </div>

      <!-- Category Tags -->
      <div>
        <label class="block font-medium text-gray-700 mb-1">Tags (Choose what fits your topic)</label>
        <div class="flex flex-wrap gap-2">
          @foreach(['Anxiety', 'Loneliness', 'Sleep', 'Spirituality', 'Relationships', 'Confidence'] as $tag)
            <label class="inline-flex items-center space-x-2 bg-indigo-50 px-3 py-1 rounded-full text-sm">
              <input type="checkbox" name="tags[]" value="{{ $tag }}" class="accent-indigo-600">
              <span>{{ $tag }}</span>
            </label>
          @endforeach
        </div>
      </div>

      <!-- Body -->
      <div>
        <label for="body" class="block font-medium text-gray-700 mb-1">Your Story / Question</label>
        <textarea name="body" id="body" rows="7" required
                  class="w-full px-4 py-3 border border-indigo-200 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                  placeholder="Write your story or question here... Remember, this is a safe space."></textarea>
      </div>

      <!-- Anonymous Toggle -->
      <div class="flex items-center space-x-3">
        <input type="checkbox" name="anonymous" id="anonymous" value="1"
               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
        <label for="anonymous" class="text-sm text-gray-700">Post Anonymously</label>
      </div>

      <!-- Submit -->
      <div class="text-right">
        <button type="submit"
                class="bg-indigo-600 text-white font-semibold px-6 py-2 rounded-md hover:bg-indigo-700 transition">
          Post Discussion
        </button>
      </div>
    </form>

  </div>
</x-app-layout>
