<!-- resources/views/forum/partials/reply.blade.php -->
<div id="reply-{{ $reply->id }}" class="bg-green-50 rounded-xl p-5 mb-4">
    <div class="flex items-start gap-4">
        <!-- User Avatar -->
        <div class="flex-shrink-0">
            @if($reply->anonymous || !$reply->user)
                <div class="bg-white w-10 h-10 rounded-full flex items-center justify-center text-green-800 font-bold text-sm">A</div>
            @else
                <div class="bg-white w-10 h-10 rounded-full flex items-center justify-center text-green-800 font-bold text-sm">
                    {{ substr($reply->user->name, 0, 1) }}
                </div>
            @endif
        </div>
        
        <!-- Reply Content -->
        <div class="flex-1">
            <div class="flex justify-between">
                <p class="text-gray-600 text-sm font-medium">
                    {{ $reply->anonymous ? 'Anonymous' : ($reply->user ? $reply->user->name : 'Deleted User') }}
                </p>
                <span class="text-xs text-green-600">
                    {{ $reply->created_at?->diffForHumans() ?? 'Just now' }}
                </span>
            </div>
            <div class="mt-2 text-gray-700">
                {!! nl2br(e($reply->body)) !!}
            </div>
        </div>
    </div>
</div>