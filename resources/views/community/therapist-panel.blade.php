<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Therapist Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 h-screen flex flex-col">

  <!-- Fixed Top Navbar -->
  <header class="bg-white shadow z-10 w-full fixed top-0 left-0 h-16 flex items-center px-6 justify-between">
    <div class="text-xl font-bold text-green-700">🧠 Moodify <span class="text-gray-600">| Therapist Panel</span></div>
    <div class="flex gap-4 items-center">
      <a href="{{ route('therapist.panel') }}" class="text-sm font-medium text-green-600 hover:underline">Dashboard</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="text-sm text-red-500 hover:text-red-700 font-medium">Logout</button>
      </form>
    </div>
  </header>

  <!-- Main Layout -->
  <div class="flex flex-1 pt-16 overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-72 bg-white border-r shadow-sm overflow-y-auto flex-shrink-0">
      <div class="p-6">
        <h2 class="text-lg font-semibold text-green-700 mb-4">👥 Conversations</h2>
        <ul class="space-y-2">
          @foreach($users as $chatUser)
          <li class="relative">
            <a href="{{ route('therapist.chat.with', $chatUser->id) }}"
               class="block p-3 rounded-md border border-green-100 hover:bg-green-50 transition
                      {{ isset($selectedUser) && $selectedUser->id === $chatUser->id ? 'bg-green-50 font-semibold text-green-800' : 'text-gray-700' }}">
              <div class="flex justify-between items-center">
                <div>
                  <div class="text-sm">{{ $chatUser->name ?? 'Anonymous' }}</div>
                  <div class="text-xs text-gray-500 truncate">{{ $chatUser->email }}</div>
                </div>

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
        @php
          $firstVisit = $messages->first(function ($msg) {
              return $msg->first_visit !== null;
          });
        @endphp
        
        <div class="mb-5 flex justify-between items-center">
          <div>
            <h3 class="text-2xl font-bold text-green-800">💬 Chat with {{ $selectedUser->name ?? 'Anonymous' }}</h3>
            @if($firstVisit)
              <div class="flex items-center gap-2 mt-2">
                <span class="text-sm font-medium text-gray-600">First visit:</span>
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm flex items-center gap-2">
                  @if($firstVisit->first_visit === 'voice')
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                  </svg>
                  Voice Call
                  @elseif($firstVisit->first_visit === 'video')
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                  </svg>
                  Video Call
                  @else
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  Physical Visit
                  @endif
                </span>
              </div>
            @endif
          </div>
          
          <div>
            @if(!$messages->contains('is_conclusion', true))
            <button id="show-conclusion-btn" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Add Conclusion
            </button>
            @endif
          </div>
        </div>

        <!-- Chat Box -->
        <div id="chat-box" class="bg-white border rounded-lg p-5 shadow-sm h-[450px] overflow-y-auto space-y-4">
          @foreach ($messages as $message)
            <div class="flex {{ $message->from_therapist ? 'justify-end' : 'justify-start' }}">
              <div class="{{ $message->from_therapist ? 'bg-green-600 text-white' : 'bg-green-100 text-gray-800' }} px-4 py-3 rounded-xl max-w-[75%] shadow-sm">
                @if($message->is_conclusion)
                  <div class="flex items-center gap-2 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-xs font-bold text-green-100">FINAL CONCLUSION</span>
                  </div>
                @endif
                
                <p class="text-sm">{{ $message->message }}</p>
                <span class="block text-xs mt-2 text-gray-300">{{ $message->created_at->diffForHumans() }}</span>
              </div>
            </div>
          @endforeach
        </div>

        <!-- Message Form -->
        <form id="message-form" class="mt-4 flex gap-3">
          @csrf
          <input type="text" id="message" name="message" placeholder="Type a response..." required
                 class="flex-1 border border-gray-300 rounded-lg px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
          <button type="submit"
                  class="bg-green-600 text-white px-5 py-3 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
            <span>Send</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </button>
        </form>

        <!-- Conclusion Form (Hidden by default) -->
        <div id="conclusion-form" class="mt-6 bg-green-50 border border-green-200 rounded-lg p-5 hidden">
          <form method="POST" action="{{ route('therapist.conclusion.send', $selectedUser->id) }}">
            @csrf
            <label class="block mb-2 text-sm font-medium text-green-700 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Final Conclusion
            </label>
            <textarea name="conclusion" rows="4" class="w-full p-3 border border-green-200 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Type a summary or final advice..."></textarea>
            
            <div class="flex justify-end gap-3 mt-3">
              <button type="button" id="cancel-conclusion-btn" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                Cancel
              </button>
              <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Save Conclusion
              </button>
            </div>
          </form>
        </div>

      @else
        <div class="flex flex-col items-center justify-center h-full text-gray-400 py-20">
          <div class="bg-green-100 text-green-800 rounded-xl w-24 h-24 flex items-center justify-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
          </div>
          <p class="text-lg font-medium">👈 Select a user to start a conversation</p>
          <p class="mt-2 text-sm max-w-md text-center">Begin by selecting a patient from the sidebar. You can view conversation history, provide therapy sessions, and save final conclusions.</p>
        </div>
      @endif
    </main>
  </div>

@if(isset($selectedUser))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('message-form');
    const chatBox = document.getElementById('chat-box');
    const messageInput = document.getElementById('message');
    const selectedUserId = {{ $selectedUser->id ?? 'null' }};
    
    // Toggle conclusion form
    const showConclusionBtn = document.getElementById('show-conclusion-btn');
    const conclusionForm = document.getElementById('conclusion-form');
    const cancelConclusionBtn = document.getElementById('cancel-conclusion-btn');
    
    if(showConclusionBtn) {
      showConclusionBtn.addEventListener('click', function() {
        conclusionForm.classList.toggle('hidden');
      });
    }
    
    if(cancelConclusionBtn) {
      cancelConclusionBtn.addEventListener('click', function() {
        conclusionForm.classList.add('hidden');
      });
    }

    form.addEventListener('submit', function(e) {
      e.preventDefault();

      const message = messageInput.value.trim();
      if (!message) return;

      fetch(`/therapist-chat/send/${selectedUserId}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ message })
      })
      .then(res => res.json())
      .then(data => {
        messageInput.value = '';
        loadMessages();
      })
      .catch(err => {
        alert('Failed to send message');
        console.error(err);
      });
    });

    function loadMessages() {
      fetch(`/therapist-chat/fetch/${selectedUserId}`)
        .then(res => res.json())
        .then(messages => {
          chatBox.innerHTML = '';
          messages.forEach(msg => {
            const align = msg.from_therapist ? 'justify-end' : 'justify-start';
            const bg = msg.from_therapist ? 'bg-green-600 text-white' : 'bg-green-100 text-gray-800';
            const conclusionBadge = msg.is_conclusion ? `
              <div class="flex items-center gap-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-xs font-bold text-green-100">FINAL CONCLUSION</span>
              </div>
            ` : '';

            chatBox.innerHTML += `
              <div class="flex ${align}">
                <div class="${bg} px-4 py-3 rounded-xl max-w-[75%] shadow-sm">
                  ${conclusionBadge}
                  <p class="text-sm">${msg.message}</p>
                  <span class="block text-xs mt-2 text-gray-300">${new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</span>
                </div>
              </div>`;
          });
          chatBox.scrollTop = chatBox.scrollHeight;
        });
    }

    setInterval(loadMessages, 3000);
    loadMessages();
  });
</script>
@endif

</body>
</html>