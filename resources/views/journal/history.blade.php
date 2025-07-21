<x-app-layout>
    <div class="pt-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-3xl font-bold text-amber-700">Your Journal History</h1>
                <p class="text-amber-600 mt-2">Reflect on your thoughts and feelings over time</p>
            </div>
            
            <!-- Search and Filter -->
            <div class="bg-white rounded-xl shadow-md p-4 mb-6 flex flex-col sm:flex-row justify-between items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0">
                    <div class="relative">
                        <input type="text" placeholder="Search journal entries..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-amber-500 focus:border-amber-500">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                
                <div class="flex space-x-2">
                    <button class="px-4 py-2 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200 transition">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                    <a href="{{ route('journal.create') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg transition flex items-center">
                        <i class="fas fa-plus mr-2"></i>New Entry
                    </a>
                </div>
            </div>
            
            <!-- Journal Entries -->
            <div class="space-y-6">
                @forelse($entries as $entry)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-amber-100 hover:shadow-lg transition">
                    <div class="p-5 border-b border-amber-100 bg-amber-50">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-bold text-amber-800">{{ $entry->title }}</h2>
                            <div class="flex space-x-2">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    {{ $entry->privacy === 'private' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $entry->privacy === 'private' ? '🔒 Private' : '👥 Shared' }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($entry->entry_date)->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-5">
                        <div class="prose max-w-none">
                            {!! nl2br(e($entry->content)) !!}
                        </div>
                        
                        <div class="mt-6 flex justify-between items-center">
                            <div class="flex space-x-2">
                                <a href="{{ route('journal.edit', $entry) }}" class="p-2 bg-amber-100 text-amber-600 rounded-full hover:bg-amber-200 transition">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('journal.destroy', $entry) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this journal entry?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-100 text-red-600 rounded-full hover:bg-red-200 transition">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <span class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($entry->created_at)->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-2xl shadow-md p-12 text-center">
                    <div class="mx-auto w-24 h-24 rounded-full bg-amber-100 flex items-center justify-center mb-6">
                        <i class="fas fa-book-open text-amber-600 text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-2">No Journal Entries Yet</h3>
                    <p class="text-gray-600 mb-6">Start your journaling journey by writing your first entry</p>
                    <a href="{{ route('journal.create') }}" class="inline-block px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white rounded-lg transition">
                        <i class="fas fa-plus mr-2"></i>Create First Entry
                    </a>
                </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            @if($entries->hasPages())
            <div class="mt-10">
                {{ $entries->links() }}
            </div>
            @endif
            
            <!-- Quick Stats -->
            <div class="mt-10 bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-xl font-bold text-amber-800 mb-4">Journal Insights</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-amber-50 p-4 rounded-lg">
                        <div class="text-amber-600 text-sm">Total Entries</div>
                        <div class="text-2xl font-bold text-amber-800">{{ $totalEntries }}</div>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <div class="text-purple-600 text-sm">Most Active Day</div>
                        <div class="text-2xl font-bold text-purple-800">{{ $mostActiveDay }}</div>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <div class="text-green-600 text-sm">Longest Entry</div>
                        <div class="text-2xl font-bold text-green-800">{{ $longestEntry }} words</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>