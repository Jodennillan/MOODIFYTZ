<!-- resources/views/forum/show.blade.php -->
<x-app-layout>
  <div class="pt-24 max-w-3xl mx-auto py-12 px-6">
    <!-- Back Button -->
    <a href="{{ route('forum.index') }}" class="flex items-center text-green-600 mb-6">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
      </svg>
      Back to Discussions
    </a>

    <!-- Main Post -->
    <div class="bg-white rounded-xl border border-green-100 shadow-sm p-6 mb-6">
      <div class="flex items-start gap-4">
        <!-- User Avatar -->
        <div class="flex-shrink-0">
          @if($post->anonymous || !$post->user)
            <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center text-green-800 font-bold">A</div>
          @else
            <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center text-green-800 font-bold">
              {{ substr($post->user->name, 0, 1) }}
            </div>
          @endif
        </div>
        
        <!-- Post Content -->
        <div class="flex-1">
          <div class="flex flex-wrap justify-between gap-2">
            <h1 class="text-2xl font-bold text-green-800">{{ $post->title }}</h1>
            <div class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded-full">
              {{ $post->created_at?->diffForHumans() ?? 'Recently' }}
            </div>
          </div>
          
          <p class="text-gray-600 text-sm mt-1">
            by {{ $post->anonymous ? 'Anonymous' : ($post->user ? $post->user->name : 'Deleted User') }}
          </p>

          <!-- Body -->
          <div class="mt-4 text-gray-700 prose prose-green max-w-none">
            {!! nl2br(e($post->body)) !!}
          </div>

          <!-- Tags -->
          @if ($post->tags)
            <div class="flex flex-wrap gap-2 mt-4">
              @foreach ($post->tags as $tag)
                <span class="bg-green-50 px-3 py-1 rounded-full text-xs text-green-700 font-medium">
                  #{{ $tag }}
                </span>
              @endforeach
            </div>
          @endif

          <!-- Reactions -->
          <div class="flex gap-6 mt-6 text-sm text-gray-500">
            <div class="flex items-center gap-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
              </svg>
              <span id="reply-count">{{ $post->replies->count() }}</span>
              <span>{{ Str::plural('reply', $post->replies->count()) }}</span>
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

    <!-- Reply Form -->
    <div class="bg-white rounded-xl border border-green-100 shadow-sm p-6 mb-8">
      <h2 class="text-xl font-bold text-green-800 mb-4">Post a Reply</h2>
      <form id="reply-form" action="{{ route('forum.reply.store', $post) }}" method="POST">
        @csrf
        <div class="mb-4">
          <textarea 
            name="body" 
            id="reply-body"
            rows="4" 
            class="w-full px-4 py-2 rounded-lg border border-green-200 focus:ring-green-500 focus:border-green-500" 
            placeholder="Share your thoughts..."
            required></textarea>
          <div id="reply-error" class="text-red-500 text-sm mt-1 hidden"></div>
        </div>
        <div class="flex justify-between items-center">
          <label class="flex items-center text-sm text-gray-600">
            <input 
              type="checkbox" 
              name="anonymous" 
              class="rounded border-green-300 text-green-600 focus:ring-green-500 mr-2">
            Post as Anonymous
          </label>
          <button 
            id="reply-submit"
            type="submit"
            class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition text-sm font-semibold">
            Post Reply
          </button>
        </div>
      </form>
    </div>

    <!-- Replies Section -->
    <div>
      <h2 class="text-xl font-bold text-green-800 mb-4">
        <span id="reply-count-display">{{ $post->replies->count() }}</span>
        {{ Str::plural('Reply', $post->replies->count()) }}
      </h2>

      <div id="replies-list">
        @forelse($post->replies->sortByDesc('created_at') as $reply)
          <div class="reply-item bg-green-50 rounded-xl p-5 mb-4" id="reply-{{ $reply->id }}">
            <div class="flex items-start gap-4">
              <!-- User Avatar -->
              <div class="flex-shrink-0">
                @if($reply->anonymous || !$reply->user)
                  <div class="bg-white w-10 h-10 rounded-full flex items-center justify-center text-green-800 font-bold text-sm">A</div>
                @else
                  <div class="bg-white w-10 h-10 rounded-full flex items-center justify-center text-green-800 font-bold text-sm">
                    {{ substr($reply->user->name, 0, 1) }}
                  </div>
                @endif
              </div>
              
              <!-- Reply Content -->
              <div class="flex-1">
                <div class="flex justify-between">
                  <p class="text-gray-600 text-sm font-medium">
                    {{ $reply->anonymous ? 'Anonymous' : ($reply->user ? $reply->user->name : 'Deleted User') }}
                  </p>
                  <span class="text-xs text-green-600">
                    {{ $reply->created_at?->diffForHumans() ?? 'Recently' }}
                  </span>
                </div>
                <div class="mt-2 text-gray-700">
                  {!! nl2br(e($reply->body)) !!}
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="text-center py-8 bg-green-50 rounded-xl" id="no-replies">
            <p class="text-green-600">No replies yet. Be the first to respond!</p>
          </div>
        @endforelse
      </div>
    </div>
  </div>
</x-app-layout>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  // Like functionality
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

  // AJAX Reply Form Submission
  const replyForm = document.getElementById('reply-form');
  if (replyForm) {
    replyForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      
      const formData = new FormData(replyForm);
      const submitBtn = document.getElementById('reply-submit');
      const errorDiv = document.getElementById('reply-error');
      const replyBody = document.getElementById('reply-body');
      
      // Show loading state
      submitBtn.disabled = true;
      submitBtn.textContent = 'Posting...';
      errorDiv.classList.add('hidden');
      
      try {
        const response = await fetch(replyForm.action, {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        });
        
        const data = await response.json();
        
        if (response.ok) {
          // Add new reply to the top
          const repliesList = document.getElementById('replies-list');
          const newReply = document.createElement('div');
          newReply.className = 'reply-item bg-green-50 rounded-xl p-5 mb-4';
          newReply.id = `reply-${data.reply.id}`;
          newReply.innerHTML = `
            <div class="flex items-start gap-4">
              <div class="flex-shrink-0">
                ${data.anonymous ? 
                  '<div class="bg-white w-10 h-10 rounded-full flex items-center justify-center text-green-800 font-bold text-sm">A</div>' : 
                  `<div class="bg-white w-10 h-10 rounded-full flex items-center justify-center text-green-800 font-bold text-sm">
                    ${data.user_initials}
                  </div>`}
              </div>
              <div class="flex-1">
                <div class="flex justify-between">
                  <p class="text-gray-600 text-sm font-medium">
                    ${data.anonymous ? 'Anonymous' : data.user_name}
                  </p>
                  <span class="text-xs text-green-600">
                    Just now
                  </span>
                </div>
                <div class="mt-2 text-gray-700">
                  ${data.body.replace(/\n/g, '<br>')}
                </div>
              </div>
            </div>
          `;
          
          // Remove "no replies" message if it exists
          const noReplies = document.getElementById('no-replies');
          if (noReplies) noReplies.remove();
          
          // Add to top of replies list
          repliesList.insertBefore(newReply, repliesList.firstChild);
          
          // Update reply count
          const replyCount = document.getElementById('reply-count');
          const replyCountDisplay = document.getElementById('reply-count-display');
          const newCount = parseInt(replyCount.textContent) + 1;
          
          replyCount.textContent = newCount;
          replyCountDisplay.textContent = newCount;
          
          // Update text pluralization
          const replyText = replyCount.nextSibling;
          replyText.textContent = newCount === 1 ? ' reply' : ' replies';
          
          // Clear form
          replyForm.reset();
          
          // Scroll to new reply
          newReply.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        } else {
          // Show error message
          errorDiv.textContent = data.message || 'Error posting reply';
          errorDiv.classList.remove('hidden');
        }
      } catch (error) {
        console.error('Error:', error);
        errorDiv.textContent = 'Network error. Please try again.';
        errorDiv.classList.remove('hidden');
      } finally {
        // Reset button
        submitBtn.disabled = false;
        submitBtn.textContent = 'Post Reply';
      }
    });
  }
});
</script>
<style>
.reply-item {
  animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
@endpush