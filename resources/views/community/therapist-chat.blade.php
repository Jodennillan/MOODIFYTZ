<x-app-layout>
  <div class="pt-24 max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="text-center mb-6">
      <h2 class="text-3xl font-extrabold text-indigo-800">💬 Talk to a Therapist</h2>
      <p class="text-sm text-gray-600 mt-1">Private & secure. Only you and the therapist can see this conversation.</p>
    </div>

    <!-- Chat Container -->
    <div id="chat-box" class="bg-white rounded-lg shadow-md p-4 h-[500px] overflow-y-scroll space-y-4">
  @foreach ($messages as $message)
    <div class="flex {{ $message->from_therapist ? 'justify-start' : 'justify-end' }}">
      <div class="{{ $message->from_therapist ? 'bg-indigo-100 text-gray-800' : 'bg-indigo-600 text-white' }} px-4 py-2 rounded-lg max-w-[70%]">
        <p class="text-sm">{{ $message->message }}</p>
        <span class="block text-xs mt-1 text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
      </div>
    </div>
  @endforeach
</div>


    <!-- Message Form -->
    <form method="POST" action="{{ route('therapist.message.send') }}" class="mt-6 flex items-center gap-3">
      @csrf
      <input type="text" name="message" placeholder="Type your message..."
             class="flex-1 border border-gray-300 rounded-full px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
             required>
      <button type="submit"
              class="bg-indigo-600 text-white px-6 py-2 rounded-full hover:bg-indigo-700 transition shadow-md">
        Send
      </button>
    </form>

  </div>

  <!-- Custom Scrollbar -->
  <style>
    .custom-scroll::-webkit-scrollbar {
      width: 6px;
    }
    .custom-scroll::-webkit-scrollbar-track {
      background: transparent;
    }
    .custom-scroll::-webkit-scrollbar-thumb {
      background-color: rgba(99, 102, 241, 0.3); /* indigo-500 transparent */
      border-radius: 4px;
    }
  </style>
</x-app-layout>
@if(isset($selectedUser))
<script>
    setInterval(() => {
        fetch('{{ route('user.chat.fetch', $therapistId) }}')
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


