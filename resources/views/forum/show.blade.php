<x-app-layout>
  <div class="max-w-3xl mx-auto py-12 px-6">
    <div class="bg-white shadow-md rounded-lg p-6">
      <h2 class="text-2xl font-bold text-indigo-800">{{ $post->title }}</h2>

      <p class="text-gray-600 text-sm mt-1">
        Posted {{ $post->created_at->diffForHumans() }} 
        by {{ $post->anonymous ? 'Anonymous' : $post->user?->name }}
      </p>

      <div class="mt-6 text-gray-800 leading-relaxed">
        {!! nl2br(e($post->body)) !!}
      </div>

      @if ($post->tags)
        <div class="mt-6">
          <h4 class="text-sm font-semibold text-indigo-600">Tags:</h4>
          <div class="flex flex-wrap gap-2 mt-2">
            @foreach ($post->tags as $tag)
              <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-xs font-medium">
                #{{ $tag }}
              </span>
            @endforeach
          </div>
        </div>
      @endif
    </div>

    <h3 class="text-lg font-bold mt-10 mb-4">Replies</h3>

@foreach($post->replies as $reply)
  <div class="bg-indigo-50 p-4 rounded mb-2">
    <div class="text-sm text-gray-700">
      <strong>{{ $reply->user->name }}</strong> • {{ $reply->created_at->diffForHumans() }}
    </div>
    <p class="text-gray-800 mt-1">{{ $reply->body }}</p>
  </div>
@endforeach

<!-- Add Reply Form -->
@auth
  <form method="POST" action="{{ route('forum.reply.store', $post->id) }}" class="mt-6">
    @csrf
    <textarea name="body" rows="3" class="w-full p-3 border rounded" placeholder="Write your reply..." required></textarea>
    <button class="bg-indigo-600 text-white px-4 py-2 mt-2 rounded hover:bg-indigo-700 transition">Post Reply</button>
  </form>
@else
  <p class="text-sm text-gray-600">Please <a href="/login" class="text-indigo-600 underline">log in</a> to reply.</p>
@endauth
  </div>
</x-app-layout>
