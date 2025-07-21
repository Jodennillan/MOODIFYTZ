<!-- resources/views/forum/index.blade.php -->
<x-app-layout>
  <div class="pt-24 max-w-5xl mx-auto py-12 px-6">
    <!-- Header with New Post Button -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
      <div>
        <h1 class="text-3xl font-bold text-green-800 flex items-center gap-3">
          <span class="bg-green-100 p-2 rounded-full">🌿</span>
          Community Garden
        </h1>
        <p class="text-green-600 mt-2">Share your journey and connect with others in a supportive environment</p>
      </div>
      <a href="{{ route('forum.create') }}"
         class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition text-sm font-semibold flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        Start New Discussion
      </a>
    </div>

    <!-- Filter and Search -->
    <div class="bg-green-50 rounded-lg p-4 mb-6 flex flex-col md:flex-row gap-4">
      <div class="flex-1">
        <div class="relative">
          <input type="text" placeholder="Search discussions..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-green-200 focus:ring-green-500 focus:border-green-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-2.5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </div>
      </div>
      <div>
        <select class="w-full md:w-auto px-4 py-2 rounded-lg border border-green-200 focus:ring-green-500 focus:border-green-500 text-green-700 bg-white">
          <option>All Topics</option>
          <option>Anxiety</option>
          <option>Loneliness</option>
          <option>Sleep</option>
          <option>Spirituality</option>
          <option>Relationships</option>
          <option>Confidence</option>
        </select>
      </div>
      <div>
        <select class="w-full md:w-auto px-4 py-2 rounded-lg border border-green-200 focus:ring-green-500 focus:border-green-500 text-green-700 bg-white">
          <option>Newest First</option>
          <option>Most Active</option>
          <option>Most Liked</option>
        </select>
      </div>
    </div>

    <!-- Forum Posts -->
    @forelse($posts as $post)
      <div class="bg-white rounded-xl border border-green-100 shadow-sm p-5 mb-6 hover:shadow-md transition duration-300">
        <div class="flex items-start gap-4">
          <!-- User Avatar -->
          <div class="flex-shrink-0">
            @if($post->anonymous)
              <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center text-green-800 font-bold">A</div>
            @else
              <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center text-green-800 font-bold">
                {{ substr($post->user->name, 0, 1) }}
              </div>
            @endif
          </div>
          
          <!-- Post Content -->
          <div class="flex-1">
            <!-- Title and metadata -->
            <div class="flex flex-wrap justify-between gap-2">
              <h2 class="text-xl font-bold text-green-800 hover:text-green-600 transition">
                <a href="{{ route('forum.show', $post->id) }}">{{ $post->title }}</a>
              </h2>
              <div class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded-full">
                {{ $post->created_at->diffForHumans() }}
              </div>
            </div>
            
            <p class="text-gray-600 text-sm mt-1">
              by {{ $post->anonymous ? 'Anonymous' : $post->user->name }}
            </p>

            <!-- Body preview -->
            <p class="mt-3 text-gray-700">{{ Str::limit(strip_tags($post->body), 200) }}</p>

            <!-- Tags -->
            @if ($post->tags)
              <div class="flex flex-wrap gap-2 mt-3">
                @foreach ($post->tags as $tag)
                  <span class="bg-green-50 px-3 py-1 rounded-full text-xs text-green-700 font-medium">
                    #{{ $tag }}
                  </span>
                @endforeach
              </div>
            @endif

            <!-- Reactions & Replies -->
            <div class="flex gap-6 mt-4 text-sm text-gray-500">
              <div class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <span>{{ $post->replies->count() }} {{ Str::plural('reply', $post->replies->count()) }}</span>
              </div>

              <!-- Like Button -->
              <button 
                class="like-btn flex items-center gap-1 text-green-600 hover:text-green-700 transition"
                data-post-id="{{ $post->id }}">
                <span class="like-icon">
                  {{ $post->isLikedBy(Auth::user()) ? '❤️' : '🤍' }}
                </span>
                <span class="like-count text-sm">{{ $post->likes->count() }}</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="text-center py-16 bg-green-50 rounded-xl">
        <div class="w-20 h-20 mx-auto bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
          </svg>
        </div>
        <h3 class="text-xl font-bold text-green-800">No discussions yet</h3>
        <p class="text-green-600 mt-2 max-w-md mx-auto">Be the first to start a conversation. Your thoughts might help someone else in their journey.</p>
        <a href="{{ route('forum.create') }}" class="mt-4 inline-block bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition text-sm font-semibold">
          Start a Discussion
        </a>
      </div>
    @endforelse

    <!-- Pagination -->
    @if($posts->hasPages())
      <div class="mt-8">
        {{ $posts->links() }}
      </div>
    @endif
  </div>
</x-app-layout>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.like-btn').forEach(button => {
    button.addEventListener('click', function () {
      const postId = this.dataset.postId;
      const icon = this.querySelector('.like-icon');
      const count = this.querySelector('.like-count');

      fetch(`/forum/${postId}/like-toggle`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        }
      })
      .then(res => res.json())
      .then(data => {
        icon.textContent = data.status === 'liked' ? '❤️' : '🤍';
        count.textContent = data.likes_count;
      })
      .catch(err => console.error('Error:', err));
    });
  });
});
</script>
@endpush