<x-app-layout>
  <div class="pt-24 max-w-5xl mx-auto py-12 px-6">
    <!-- Header with New Post Button -->
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-indigo-800">🗣 Community Discussions</h1>
      <a href="{{ route('forum.create') }}"
         class="bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700 transition text-sm font-semibold">
        + Start a Discussion
      </a>
    </div>

    <!-- Forum Posts -->
   @forelse($posts as $post)
  <div class="bg-white shadow rounded-lg p-4 mb-6">

    <!-- Title and metadata -->
    <h2 class="text-xl font-bold text-indigo-800">{{ $post->title }}</h2>
    <p class="text-gray-600 text-sm">
      Posted {{ $post->created_at->diffForHumans() }} 
      by {{ $post->anonymous ? 'Anonymous' : $post->user->name }}
    </p>

    <!-- Body preview -->
    <p class="mt-2 text-gray-700">{{ Str::limit(strip_tags($post->body), 120) }}</p>

    <!-- Tags -->
    @if ($post->tags)
      <div class="flex flex-wrap gap-2 mt-2">
        @foreach ($post->tags as $tag)
          <span class="bg-indigo-50 px-2 py-0.5 rounded-full text-xs text-indigo-700 font-medium">
            #{{ $tag }}
          </span>
        @endforeach
      </div>
    @endif

    <!-- Reactions & Replies -->
    <div class="flex justify-between items-center mt-4 text-sm text-gray-500">
      <span>{{ $post->replies->count() }} {{ Str::plural('reply', $post->replies->count()) }}</span>

      <!-- ✅ Like Form Goes Here -->
      <!-- Like Button -->
<button 
  class="like-btn flex items-center gap-1 text-red-500 hover:text-red-600 transition"
  data-post-id="{{ $post->id }}">
  <span class="like-icon">
    {{ $post->isLikedBy(Auth::user()) ? '❤️' : '🤍' }}
  </span>
  <span class="like-count text-sm">{{ $post->likes->count() }}</span>
</button>

    </div>

  </div>
@empty
  <div class="text-center text-gray-600 mt-12">
    No discussions yet. Be the first to <a href="{{ route('forum.create') }}" class="text-indigo-600 font-medium hover:underline">start one</a>!
  </div>
@endforelse


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

