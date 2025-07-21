<!-- resources/views/forum/reply-edit.blade.php -->
<x-app-layout>
  <div class="pt-24 max-w-3xl mx-auto py-12 px-6">
    <!-- Page Header -->
    <div class="text-center mb-10">
      <div class="w-20 h-20 mx-auto bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
      </div>
      <h1 class="text-3xl font-extrabold text-green-800 mb-2">Edit Response</h1>
    </div>

    <!-- Reply Form -->
    <form method="POST" action="{{ route('forum.reply.update', $reply->id) }}" class="space-y-6 bg-white rounded-xl border border-green-100 p-6">
      @csrf
      @method('PUT')

      <div>
        <label for="body" class="block font-medium text-green-700 mb-2">Your Response</label>
        <textarea name="body" id="body" rows="5" required
                  class="w-full px-4 py-3 border border-green-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 shadow-sm"
                  placeholder="Share your thoughts...">{{ old('body', $reply->body) }}</textarea>
      </div>

      <!-- Submit -->
      <div class="flex justify-between pt-4">
        <a href="{{ route('forum.show', $reply->forum_post_id) }}" class="text-green-600 hover:text-green-800 flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Cancel
        </a>
        <button type="submit"
                class="bg-green-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-green-700 transition">
          Update Response
        </button>
      </div>
    </form>
  </div>
</x-app-layout>