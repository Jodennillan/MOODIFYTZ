<x-app-layout>
<div class="h-screen pt-16 bg-indigo-50">
    <!-- Chat Header -->
    <div class="flex items-center justify-between px-6 py-4 bg-white border-b shadow-sm">
        <div class="text-lg font-semibold text-indigo-700">
            👤 Chatting with {{ $receiver->name }}
        </div>
        <a href="{{ route('peer.group') }}"
           class="text-sm bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
            ⬅️ Back to Group Chat
        </a>
    </div>

    <!-- Chat Body -->
    <div class="px-6 py-4 flex flex-col h-[calc(100vh-10rem)] overflow-hidden">
        <div id="chat-box" class="flex-1 space-y-4 overflow-y-auto pr-3">
            @forelse ($messages as $msg)
                <div class="flex {{ $msg->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="{{ $msg->user_id === auth()->id() ? 'bg-indigo-600 text-white' : 'bg-white text-gray-800' }}
                                px-4 py-2 rounded-lg max-w-[70%] shadow">
                        <p class="text-sm">{{ $msg->message }}</p>
                        <span class="block text-xs mt-1 text-gray-300">
                            {{ $msg->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">No messages yet. Start the conversation!</p>
            @endforelse
        </div>

        <!-- Message Form -->
        <form action="{{ route('peer.dm.send', $receiver->id) }}" method="POST" class="mt-4 flex gap-3">
            @csrf
            <input type="text" name="message" placeholder="Type your message..." required
                   class="flex-1 px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring focus:border-indigo-500">
            <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-full hover:bg-indigo-700 transition">
                Send
            </button>
        </form>
    </div>
</div>
</x-app-layout>
