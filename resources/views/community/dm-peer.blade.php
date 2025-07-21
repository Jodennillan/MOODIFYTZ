<x-app-layout>
<div class="pt-10 flex h-screen overflow-hidden bg-gray-50">

    <!-- Sidebar with Peers -->
    <aside class="w-64 bg-white border-r shadow-lg flex flex-col">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-green-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                </svg>
                Active Peers
            </h2>
        </div>
        
        <div class="flex-1 overflow-y-auto">
            <div class="p-4">
                <div class="mb-4">
                    <a href="{{ route('peer.group') }}" 
                       class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg font-medium">
                        <div class="bg-gray-100 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                            </svg>
                        </div>
                        Group Chat
                    </a>
                </div>
                
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 mb-2">Direct Messages</h3>
                <ul class="space-y-2">
                    @foreach($peers as $peer)
                    <li>
                        <a href="{{ route('peer.dm', $peer->id) }}"
                           class="flex items-center gap-3 px-4 py-3 rounded-lg transition
                                  {{ $peer->id == $receiver->id ? 'bg-green-50 border border-green-100' : 'hover:bg-gray-100' }}">
                            <div class="relative">
                                <div class="bg-green-100 text-green-800 rounded-xl w-10 h-10 flex items-center justify-center font-semibold">
                                    {{ substr($peer->name, 0, 1) }}
                                </div>
                                <div class="absolute bottom-0 right-0 w-3 h-3 {{ $peer->is_online ? 'bg-green-500' : 'bg-gray-400' }} rounded-full border-2 border-white"></div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-gray-900 truncate">{{ $peer->name }}</p>
                                <p class="text-xs {{ $peer->is_online ? 'text-green-600' : 'text-gray-500' }} truncate">
                                    {{ $peer->is_online ? 'Online now' : 'Offline' }}
                                </p>
                            </div>
                            @if($peer->id == $receiver->id)
                            <div class="w-2 h-2 bg-green-600 rounded-full"></div>
                            @endif
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </aside>

    <!-- Main Chat Area -->
    <main class="flex-1 flex flex-col">
        <header class="px-6 py-4 border-b bg-white shadow-sm">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div class="bg-green-100 text-green-800 rounded-xl w-12 h-12 flex items-center justify-center font-semibold">
                        {{ substr($receiver->name, 0, 1) }}
                    </div>
                    <div class="absolute bottom-0 right-0 w-3 h-3 {{ $receiver->is_online ? 'bg-green-500' : 'bg-gray-400' }} rounded-full border-2 border-white"></div>
                </div>
                <div>
                    <h1 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        {{ $receiver->name }}
                        @if($receiver->is_online)
                        <span class="text-xs font-normal bg-green-100 text-green-800 px-2 py-1 rounded-full flex items-center gap-1">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            Online
                        </span>
                        @else
                        <span class="text-xs font-normal bg-gray-100 text-gray-800 px-2 py-1 rounded-full">
                            Offline
                        </span>
                        @endif
                    </h1>
                    <p class="text-sm text-gray-500">Private conversation</p>
                </div>
            </div>
        </header>

        <section id="chat-box" class="flex-1 overflow-y-auto p-6 bg-gray-100">
            <div class="max-w-3xl mx-auto space-y-5">
                @forelse ($messages as $msg)
                <div class="{{ $msg->user_id === auth()->id() ? 'flex justify-end' : 'flex justify-start' }}">
                    <div class="max-w-[85%]">
                        @if($msg->user_id !== auth()->id())
                        <div class="flex items-center gap-2 mb-1 ml-1">
                            <div class="bg-green-100 text-green-800 rounded-xl w-8 h-8 flex items-center justify-center font-medium text-sm">
                                {{ substr($msg->user->name, 0, 1) }}
                            </div>
                            <span class="text-xs font-medium text-gray-700">{{ $msg->user->name }}</span>
                            <span class="text-xs text-gray-400">{{ $msg->created_at->format('h:i A') }}</span>
                        </div>
                        @endif
                        
                        <div class="flex gap-2 {{ $msg->user_id === auth()->id() ? 'flex-row-reverse' : '' }}">
                            @if($msg->user_id !== auth()->id())
                            <div class="flex-shrink-0"></div> <!-- Placeholder for alignment -->
                            @endif
                            <div class="{{ $msg->user_id === auth()->id() ? 'bg-green-600 text-white' : 'bg-white text-gray-800' }}
                                        px-4 py-3 rounded-2xl shadow-sm">
                                <p class="text-sm">{{ $msg->message }}</p>
                            </div>
                        </div>
                        
                        @if($msg->user_id === auth()->id())
                        <div class="text-right mt-1 mr-1">
                            <span class="text-xs text-gray-400">{{ $msg->created_at->format('h:i A') }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-10">
                    <div class="bg-green-100 text-green-800 rounded-xl w-16 h-16 flex items-center justify-center font-semibold text-2xl mx-auto">
                        {{ substr($receiver->name, 0, 1) }}
                    </div>
                    <h3 class="mt-4 font-medium text-gray-900">No messages yet</h3>
                    <p class="text-gray-500 mt-1">Send your first message to start the conversation</p>
                </div>
                @endforelse
            </div>
        </section>

        <!-- Message Form -->
        <footer class="p-4 border-t bg-white">
            <form action="{{ route('peer.dm.send', $receiver->id) }}" method="POST" class="flex items-center gap-3">
                @csrf
                <input type="text" name="message" placeholder="Type a private message..." required
                    class="flex-1 px-4 py-3 border rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-300">
                <button type="submit"
                    class="bg-green-600 text-white px-5 py-3 rounded-2xl hover:bg-green-700 transition flex items-center gap-2">
                    <span>Send</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        </footer>
    </main>
</div>
</x-app-layout>