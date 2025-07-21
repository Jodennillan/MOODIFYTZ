<x-app-layout>
    <div class="pt-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl p-6 sm:p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-amber-700">Edit Journal Entry</h1>
                <p class="text-amber-600 mt-2">Update your thoughts and reflections</p>
            </div>
            
            <form method="POST" action="{{ route('journal.update', $entry) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label class="block text-base font-medium text-gray-800 mb-2">Entry Title</label>
                    <input type="text" name="title" required 
                           class="w-full border border-gray-300 p-3 rounded-lg focus:ring-amber-500 focus:border-amber-500"
                           value="{{ $entry->title }}">
                </div>
                
                <div class="mb-6">
                    <label class="block text-base font-medium text-gray-800 mb-2">Your Reflection</label>
                    <textarea name="content" rows="6" required
                              class="w-full border border-gray-300 p-3 rounded-lg focus:ring-amber-500 focus:border-amber-500">{{ $entry->content }}</textarea>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-base font-medium text-gray-800 mb-2">Entry Date</label>
                        <input type="date" name="entry_date" required 
                               class="w-full border border-gray-300 p-3 rounded-lg focus:ring-amber-500 focus:border-amber-500"
                               value="{{ $entry->entry_date }}">
                    </div>
                    
                    <div>
                        <label class="block text-base font-medium text-gray-800 mb-2">Privacy Setting</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="privacy" value="private" 
                                       class="text-amber-600 focus:ring-amber-500"
                                       {{ $entry->privacy === 'private' ? 'checked' : '' }}>
                                <span class="ml-2">Private (Only you can see this)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="privacy" value="shared" 
                                       class="text-amber-600 focus:ring-amber-500"
                                       {{ $entry->privacy === 'shared' ? 'checked' : '' }}>
                                <span class="ml-2">Share with therapist</span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-between">
                    <a href="{{ route('journal.history') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white rounded-lg transition">
                        Update Journal Entry
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>