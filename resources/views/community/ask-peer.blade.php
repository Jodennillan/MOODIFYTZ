<x-app-layout>
<div class="pt-10 flex h-screen overflow-hidden">

    <!-- Sidebar with Peers -->
    <aside class="w-64 bg-white border-r shadow-md">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-indigo-700">🧑‍🤝‍🧑 Peers</h2>
            <ul class="mt-4 space-y-2 text-sm text-gray-700">
                @foreach($peers as $peer)
                    @if($peer->id !== auth()->id())
                    <li>
                        <a href="{{ route('peer.dm', $peer->id) }}"
                           class="flex items-center justify-between px-3 py-2 hover:bg-indigo-50 rounded transition">
                            <span>{{ $peer->name }}</span>
                            <span class="text-xs text-gray-400">Chat</span>
                        </a>
                    </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </aside>

    <!-- Main Chat Area -->
    <main class="flex-1 flex flex-col bg-gray-50">
        <header class="px-6 py-4 border-b bg-white shadow-sm">
            <h1 class="text-lg font-bold text-indigo-700">💬 Ask a Peer - Group Chat</h1>
        </header>

        <section id="chat-box" class="flex-1 overflow-y-auto p-6 space-y-4">
            @foreach($messages as $msg)
                <div class="max-w-xl {{ $msg->user_id === auth()->id() ? 'ml-auto text-right' : '' }}">
                    <div class="inline-block px-4 py-2 rounded-lg 
                        {{ $msg->user_id === auth()->id() ? 'bg-indigo-600 text-white' : 'bg-indigo-100 text-gray-800' }}">
                        <p class="text-sm">{{ $msg->message }}</p>
                        <small class="block text-xs mt-1 opacity-60">
                            {{ $msg->user->name }} · {{ $msg->created_at->diffForHumans() }}
                        </small>
                    </div>
                </div>
            @endforeach
        </section>

        <!-- Chat Form -->
        <footer class="p-4 border-t bg-white">
            <form action="{{ route('peer.message.send') }}" method="POST" class="flex items-center space-x-3">
                @csrf
                <input type="text" name="message" placeholder="Type your message..."
                    class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-indigo-300">
                <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Send</button>
            </form>
        </footer>
    </main>
</div>
</x-app-layout>
