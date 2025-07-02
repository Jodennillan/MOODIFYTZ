<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Therapist Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-indigo-50 via-white to-white text-gray-800 min-h-screen antialiased">

  <!-- ✅ Custom Top Navigation -->
  <nav class="bg-white border-b shadow-sm fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
      <div class="text-lg font-bold text-indigo-700">🧠 Moodify | Therapist Panel</div>
      <div class="flex items-center gap-4">
        <a href="{{ route('therapist.panel') }}" class="text-sm text-indigo-600 hover:underline">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="text-sm text-red-600 hover:underline">Logout</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- ✅ Main Layout -->
  <div class="flex pt-16 h-[calc(100vh-4rem)]">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r px-4 py-6 shadow-md overflow-y-auto">
      <h2 class="text-lg font-bold text-indigo-700 mb-4">👥 Conversations</h2>

      <ul class="space-y-2">
        @foreach($users as $chatUser)
          <li>
            <a href="{{ route('therapist.chat.with', $chatUser->id) }}"
               class="block p-3 rounded-md border border-indigo-100 hover:bg-indigo-50 transition
                      {{ isset($selectedUser) && $selectedUser->id === $chatUser->id ? 'bg-indigo-100 font-semibold text-indigo-800' : 'text-gray-700' }}">
              {{ $chatUser->name ?? 'Anonymous' }}
              <div class="text-xs text-gray-500 truncate">{{ $chatUser->email }}</div>
            </a>
          </li>
        @endforeach
      </ul>
    </aside>

    <!-- Chat Section -->
    <div class="flex-1 flex flex-col p-6 overflow-y-auto">
      @if(isset($selectedUser))
        <h3 class="text-xl font-bold text-indigo-700 mb-4">💬 Chat with {{ $selectedUser->name ?? 'Anonymous' }}</h3>

        <!-- Chat Box -->
        <div id="chat-box" class="bg-white rounded-lg shadow-inner p-4 h-[450px] overflow-y-auto space-y-4">
          @forelse($messages as $message)
            <div class="flex {{ $message->from_therapist ? 'justify-end' : 'justify-start' }}">
              <div class="{{ $message->from_therapist ? 'bg-indigo-600 text-white' : 'bg-indigo-100 text-gray-800' }} px-4 py-2 rounded-lg max-w-[70%]">
                <p class="text-sm leading-relaxed">{{ $message->message }}</p>
                <span class="block text-xs mt-1 text-gray-300">{{ $message->created_at->diffForHumans() }}</span>
              </div>
            </div>
          @empty
            <p class="text-sm text-gray-500">No messages yet.</p>
          @endforelse
        </div>

        <!-- Message Form -->
        <form method="POST" action="{{ route('therapist.message.send.to', $selectedUser->id) }}" class="mt-4 flex gap-2">
          @csrf
          <input type="text" name="message" placeholder="Type a response..." required
                 class="flex-1 border border-indigo-200 rounded px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
          <button type="submit"
                  class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
            Send
          </button>
        </form>
      @else
        <div class="flex items-center justify-center h-full text-gray-400">
          <p>Select a user from the left to start a conversation.</p>
        </div>
      @endif
    </div>
  </div>

</body>
</html>
@if(isset($selectedUser))
<script>
    setInterval(() => {
        fetch('{{ route('therapist.chat.fetch', $selectedUser->id) }}')
            .then(response => response.json())
            .then(messages => {
                const chatBox = document.getElementById('chat-box');
                chatBox.innerHTML = '';

                messages.forEach(msg => {
                    const align = msg.from_therapist ? 'justify-end' : 'justify-start';
                    const bg = msg.from_therapist ? 'bg-indigo-600 text-white' : 'bg-indigo-100 text-gray-800';

                    chatBox.innerHTML += `
                        <div class="flex ${align}">
                            <div class="${bg} px-4 py-2 rounded-lg max-w-[70%]">
                                <p class="text-sm">${msg.message}</p>
                                <span class="block text-xs mt-1 text-gray-300">${new Date(msg.created_at).toLocaleString()}</span>
                            </div>
                        </div>
                    `;
                });

                chatBox.scrollTop = chatBox.scrollHeight;
            });
    }, 3000); // Refresh every 3 seconds
</script>

@endif