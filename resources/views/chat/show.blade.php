<x-app-layout>
  <div class="pt-24 max-w-3xl mx-auto px-6">
    <h1 class="text-xl font-bold text-indigo-700 mb-6">Chat with {{ $therapist->name }}</h1>

    <div class="bg-white rounded-lg shadow p-4 space-y-4 max-h-[60vh] overflow-y-auto mb-6">
      @foreach($messages as $message)
        <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
          <div class="max-w-sm px-4 py-2 rounded-lg {{ $message->sender_id === auth()->id() ? 'bg-indigo-100 text-right' : 'bg-indigo-50' }}">
            <p class="text-sm text-gray-800">{{ $message->body }}</p>
            <span class="block text-xs text-gray-500 mt-1">{{ $message->created_at->format('H:i') }}</span>
          </div>
        </div>
      @endforeach
    </div>

    <form method="POST" action="{{ route('chat.store', $therapist->id) }}">
      @csrf
      <div class="flex items-center gap-2">
        <input type="text" name="body" required autofocus placeholder="Type your message..."
               class="flex-1 border border-indigo-200 rounded-full px-4 py-2 focus:outline-none focus:ring focus:ring-indigo-100">
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition">
          Send
        </button>
      </div>
    </form>
  </div>
</x-app-layout>
