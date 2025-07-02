<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Therapist Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 h-screen flex flex-col">

  <!-- ✅ Fixed Top Navbar -->
  <header class="bg-white shadow z-10 w-full fixed top-0 left-0 h-16 flex items-center px-6 justify-between">
    <div class="text-xl font-bold text-indigo-700">🧠 Moodify <span class="text-gray-600">| Therapist Panel</span></div>
    <div class="flex gap-4 items-center">
      <a href="{{ route('therapist.panel') }}" class="text-sm font-medium text-indigo-600 hover:underline">Dashboard</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="text-sm text-red-500 hover:text-red-700 font-medium">Logout</button>
      </form>
    </div>
  </header>

  <!-- ✅ Main Layout -->
  <div class="flex flex-1 pt-16 overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-72 bg-white border-r shadow-sm overflow-y-auto flex-shrink-0">
      <div class="p-6">
        <h2 class="text-lg font-semibold text-indigo-700 mb-4">👥 Conversations</h2>
        <ul class="space-y-2">
          @foreach($users as $chatUser)
  <li class="relative">
    <a href="{{ route('therapist.chat.with', $chatUser->id) }}"
       class="block p-3 rounded-md border border-indigo-100 hover:bg-indigo-50 transition
              {{ isset($selectedUser) && $selectedUser->id === $chatUser->id ? 'bg-indigo-100 font-semibold text-indigo-800' : 'text-gray-700' }}">
      <div class="flex justify-between items-center">
        <div>
          <div class="text-sm">{{ $chatUser->name ?? 'Anonymous' }}</div>
          <div class="text-xs text-gray-500 truncate">{{ $chatUser->email }}</div>
        </div>

        {{-- 🔴 Unread Badge --}}
        @if(isset($unreadCounts[$chatUser->id]) && $unreadCounts[$chatUser->id] > 0)
          <span class="ml-2 inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full">
            {{ $unreadCounts[$chatUser->id] }}
          </span>
        @endif
      </div>
    </a>
  </li>
@endforeach

        </ul>
      </div>
    </aside>

    <!-- Chat Area -->
    <main class="flex-1 overflow-y-auto px-8 py-6 bg-gray-50">
      @if(isset($selectedUser))
        <div class="mb-5">
          <h3 class="text-2xl font-bold text-indigo-800">💬 Chat with {{ $selectedUser->name ?? 'Anonymous' }}</h3>
        </div>

        <!-- Chat Box -->
        <div id="chat-box" class="bg-white border rounded-lg p-5 shadow-sm h-[450px] overflow-y-auto space-y-4">
          @foreach ($messages as $message)
            <div class="flex {{ $message->from_therapist ? 'justify-end' : 'justify-start' }}">
              <div class="{{ $message->from_therapist ? 'bg-indigo-600 text-white' : 'bg-indigo-100 text-gray-800' }} px-4 py-2 rounded-lg max-w-[75%]">
                <p class="text-sm">{{ $message->message }}</p>
                <span class="block text-xs mt-1 text-gray-300">{{ $message->created_at->diffForHumans() }}</span>
              </div>
            </div>
          @endforeach
        </div>

        <!-- Message Form -->
        <form method="POST" action="{{ route('therapist.message.send.to', $selectedUser->id) }}" class="mt-4 flex gap-3">
          @csrf
          <input type="text" name="message" placeholder="Type a response..." required
                 class="flex-1 border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
          <button type="submit"
                  class="bg-indigo-600 text-white px-5 py-2 rounded-md hover:bg-indigo-700 transition">
            Send
          </button>
        </form>
      @else
        <div class="flex items-center justify-center h-full text-gray-400">
          <p class="text-lg font-medium">👈 Select a user from the left to start a conversation.</p>
        </div>
      @endif
    </main>
  </div>

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
              <div class="${bg} px-4 py-2 rounded-lg max-w-[75%]">
                <p class="text-sm">${msg.message}</p>
                <span class="block text-xs mt-1 text-gray-300">${new Date(msg.created_at).toLocaleString()}</span>
              </div>
            </div>
          `;
        });

        chatBox.scrollTop = chatBox.scrollHeight;
      });
  }, 3000);
</script>
@endif

</body>
</html>
