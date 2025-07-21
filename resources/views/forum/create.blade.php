<!-- resources/views/forum/create.blade.php -->
<x-app-layout>
  <div class="pt-24 max-w-3xl mx-auto py-12 px-6">
    <!-- Page Header -->
    <div class="text-center mb-10">
      <div class="w-20 h-20 mx-auto bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
      </div>
      <h1 class="text-3xl font-extrabold text-green-800 mb-2">Start a New Discussion</h1>
      <p class="text-green-600">Share your thoughts, ask questions, and support others in our community</p>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
      <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
        <div class="flex">
          <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
          </div>
          <div class="ml-3">
            <h3 class="text-sm leading-5 font-medium text-red-800">There were {{ $errors->count() }} errors with your submission</h3>
            <div class="mt-2 text-sm leading-5 text-red-700">
              <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    @endif

    <!-- Post Form -->
    <form method="POST" action="{{ route('forum.store') }}" class="space-y-6 bg-white rounded-xl border border-green-100 p-6">
      @csrf

      <!-- Title -->
      <div>
        <label for="title" class="block font-medium text-green-700 mb-2">Discussion Title</label>
        <input type="text" name="title" id="title" required
               class="w-full px-4 py-3 border border-green-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 shadow-sm"
               placeholder="What would you like to discuss?">
      </div>

      <!-- Category Tags -->
      <div>
        <label class="block font-medium text-green-700 mb-2">Topics (Select all that apply)</label>
        <div class="flex flex-wrap gap-3">
          @foreach(['Anxiety', 'Loneliness', 'Sleep', 'Spirituality', 'Relationships', 'Confidence'] as $tag)
            <label class="inline-flex items-center space-x-2 bg-green-50 px-4 py-2 rounded-lg text-sm cursor-pointer hover:bg-green-100 transition">
              <input type="checkbox" name="tags[]" value="{{ $tag }}" class="rounded border-green-300 text-green-600 shadow-sm focus:ring-green-500">
              <span class="text-green-700">{{ $tag }}</span>
            </label>
          @endforeach
        </div>
      </div>

      <!-- Body -->
      <div>
        <label for="body" class="block font-medium text-green-700 mb-2">Your Story or Question</label>
        <textarea name="body" id="body" rows="7" required
                  class="w-full px-4 py-3 border border-green-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 shadow-sm"
                  placeholder="Share your thoughts here... Remember this is a safe and supportive space."></textarea>
      </div>

      <!-- Anonymous Toggle -->
      <div class="flex items-center space-x-3">
        <input type="checkbox" name="anonymous" id="anonymous" value="1"
               class="rounded border-green-300 text-green-600 shadow-sm focus:ring-green-500">
        <label for="anonymous" class="text-green-700">Post Anonymously</label>
      </div>

      <!-- Submit -->
      <div class="flex justify-between pt-4">
        <a href="{{ route('forum.index') }}" class="text-green-600 hover:text-green-800 flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Back to Discussions
        </a>
        <button type="submit"
                class="bg-green-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
          </svg>
          Post Discussion
        </button>
      </div>
    </form>
  </div>
</x-app-layout>