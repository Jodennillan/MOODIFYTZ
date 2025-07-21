<x-app-layout>
  <div class="pt-24 max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="text-center mb-6">
      <h2 class="text-3xl font-extrabold text-green-700">💬 Talk to a Therapist</h2>
      <p class="text-sm text-gray-600 mt-1">Private & secure. Only you and the therapist can see this conversation.</p>
    </div>

    <!-- First Visit Selection -->
    @if(!$firstVisitSelected)
    <div id="first-visit-panel" class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-green-100">
      <h3 class="text-xl font-bold text-center text-gray-800 mb-4">How would you like to begin?</h3>
      <p class="text-center text-gray-600 mb-6">Please select your preferred first contact method:</p>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <button data-method="voice" class="first-visit-btn flex flex-col items-center justify-center p-6 bg-green-50 rounded-xl border-2 border-green-100 hover:bg-green-100 transition transform hover:-translate-y-1">
          <div class="bg-green-100 p-3 rounded-full mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
          </div>
          <span class="font-bold text-green-700">Voice Call</span>
          <p class="text-sm text-gray-600 mt-1">Audio conversation</p>
        </button>
        
        <button data-method="video" class="first-visit-btn flex flex-col items-center justify-center p-6 bg-green-50 rounded-xl border-2 border-green-100 hover:bg-green-100 transition transform hover:-translate-y-1">
          <div class="bg-green-100 p-3 rounded-full mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
          </div>
          <span class="font-bold text-green-700">Video Call</span>
          <p class="text-sm text-gray-600 mt-1">Face-to-face conversation</p>
        </button>
        
        <button data-method="physical" class="first-visit-btn flex flex-col items-center justify-center p-6 bg-green-50 rounded-xl border-2 border-green-100 hover:bg-green-100 transition transform hover:-translate-y-1">
          <div class="bg-green-100 p-3 rounded-full mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </div>
          <span class="font-bold text-green-700">Physical Visit</span>
          <p class="text-sm text-gray-600 mt-1">In-person appointment</p>
        </button>
      </div>
    </div>
    @endif

    <!-- Chat Container -->
    <div id="chat-box" class="bg-white rounded-xl shadow-lg p-4 h-[500px] overflow-y-auto space-y-4 custom-scroll">
      @foreach ($messages as $message)
        <div class="flex {{ $message->from_therapist ? 'justify-start' : 'justify-end' }}">
          <div class="{{ $message->from_therapist ? 'bg-green-100 text-gray-800' : 'bg-green-600 text-white' }} px-4 py-3 rounded-xl max-w-[75%] shadow-sm">
            @if($message->first_visit)
              <div class="flex items-center gap-2 mb-2">
                <div class="bg-white p-1 rounded-full">
                  @if($message->first_visit === 'voice')
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                  </svg>
                  @elseif($message->first_visit === 'video')
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                  </svg>
                  @else
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  @endif
                </div>
                <span class="text-xs font-bold text-green-600">FIRST VISIT: {{ strtoupper($message->first_visit) }}</span>
              </div>
            @endif
            
            @if($message->is_conclusion)
              <div class="flex items-center gap-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-xs font-bold text-green-600">FINAL CONCLUSION</span>
              </div>
            @endif
            
            <p class="text-sm">{{ $message->message }}</p>
            <span class="block text-xs mt-2 text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Message Form -->
    <form method="POST" action="{{ route('therapist.message.send') }}" class="mt-6 flex items-center gap-3" id="message-form">
      @csrf
      <input type="text" name="message" placeholder="Type your message..."
             class="flex-1 border border-gray-300 rounded-full px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500"
             required {{ !$firstVisitSelected ? 'disabled' : '' }}>
      <button type="submit"
              class="bg-green-600 text-white px-6 py-3 rounded-full hover:bg-green-700 transition shadow-md flex items-center gap-2"
              {{ !$firstVisitSelected ? 'disabled' : '' }}>
        <span>Send</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
        </svg>
      </button>
    </form>

  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // First visit method selection
      document.querySelectorAll('.first-visit-btn').forEach(button => {
        button.addEventListener('click', function() {
          const method = this.getAttribute('data-method');
          
          fetch("{{ route('therapist.first-visit') }}", {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ 
              first_visit: method
            })
          })
          .then(response => {
            if (!response.ok) {
              throw new Error('Network response was not ok');
            }
            return response.json();
          })
          .then(data => {
            if(data.status === 'success') {
              // Enable the form
              document.querySelector('input[name="message"]').disabled = false;
              document.querySelector('#message-form button').disabled = false;
              
              // Hide the selection UI
              document.getElementById('first-visit-panel').remove();
              
              // Add a message to the chat
              const chatBox = document.getElementById('chat-box');
              chatBox.innerHTML += `
                <div class="flex justify-end">
                  <div class="bg-green-600 text-white px-4 py-3 rounded-xl max-w-[75%] shadow-sm">
                    <div class="flex items-center gap-2 mb-2">
                      <div class="bg-white p-1 rounded-full">
                        ${method === 'voice' ? 
                          '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>' : 
                        method === 'video' ? 
                          '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>' : 
                          '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>'
                        }
                      </div>
                      <span class="text-xs font-bold text-green-100">FIRST VISIT: ${method.toUpperCase()}</span>
                    </div>
                    <p class="text-sm">First visit method selected: ${method.charAt(0).toUpperCase() + method.slice(1)}</p>
                    <span class="block text-xs mt-2 text-green-200">Just now</span>
                  </div>
                </div>
              `;
              
              // Scroll to bottom
              chatBox.scrollTop = chatBox.scrollHeight;
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('Failed to save selection. Please try again.');
          });
        });
      });
      
      // Auto-scroll to bottom
      const chatBox = document.getElementById('chat-box');
      if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
    });
  </script>
</x-app-layout>