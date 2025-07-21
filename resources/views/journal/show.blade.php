<x-app-layout>
    <div class="pt-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('journal.history') }}" class="inline-flex items-center text-amber-600 hover:text-amber-800">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Journal
                </a>
            </div>
            
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-amber-400 to-amber-600 p-6">
                    <h1 class="text-3xl font-bold text-white">{{ $entry->title }}</h1>
                    <div class="flex items-center text-amber-100 mt-2">
                        <span class="mr-4">
                            <i class="far fa-calendar mr-1"></i> 
                            {{ $entry->entry_date->format('F j, Y') }}
                        </span>
                        <span>
                            <i class="far fa-clock mr-1"></i> 
                            {{ $entry->created_at->format('g:i a') }}
                        </span>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="prose max-w-none">
                        {!! nl2br(e($entry->content)) !!}
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-amber-100 flex justify-between items-center">
                        <span class="px-3 py-1 rounded-full text-sm 
                            {{ $entry->privacy === 'private' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                            {{ $entry->privacy === 'private' ? '🔒 Private Entry' : '👥 Shared with Therapist' }}
                        </span>
                        
                        <div class="flex space-x-2">
                            <button class="px-4 py-2 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200 transition">
                                <i class="fas fa-edit mr-2"></i>Edit
                            </button>
                            <button class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">
                                <i class="fas fa-trash mr-2"></i>Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-xl font-bold text-amber-800 mb-4">Journal Insights</h2>
                <div class="flex items-center">
                    <div class="mr-4">
                        <div class="w-16 h-16 rounded-full bg-amber-100 flex items-center justify-center">
                            <i class="fas fa-font text-amber-600 text-2xl"></i>
                        </div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-600">Word Count</div>
                        <div class="text-2xl font-bold text-amber-800">{{ str_word_count($entry->content) }} words</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>