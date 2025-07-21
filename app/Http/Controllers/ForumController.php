<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumReply;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $posts = ForumPost::with(['replies', 'likes'])
                    ->withCount('replies')
                    ->orderByDesc('created_at')
                    ->paginate(10);

        return view('forum.index', compact('posts'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50',
            'anonymous' => 'nullable|boolean',
        ]);

        $post = ForumPost::create([
            'user_id' => $request->boolean('anonymous') ? null : Auth::id(),
            'title' => $validated['title'],
            'body' => $validated['body'],
            'tags' => $validated['tags'] ?? [],
            'anonymous' => $request->boolean('anonymous'),
        ]);

        return redirect()->route('forum.show', $post->id)
                         ->with('success', 'Your discussion has been created!');
    }

    
public function show(ForumPost $post)
{
    $post->load(['replies.user', 'likes', 'user']);
    return view('forum.show', compact('post'));
}

   public function storeReply(Request $request, ForumPost $post)
{
    $validated = $request->validate([
        'body' => 'required|string|max:2000',
        'anonymous' => 'nullable|boolean',
    ]);

    $reply = ForumReply::create([
        'forum_post_id' => $post->id,
        'user_id' => $request->boolean('anonymous') ? null : Auth::id(),
        'body' => $validated['body'],
        'anonymous' => $request->boolean('anonymous'),
    ]);

    // Return JSON response for AJAX handling
    if ($request->ajax()) {
        $userName = $reply->anonymous ? 'Anonymous' : ($reply->user ? $reply->user->name : 'Deleted User');
        $userInitials = $reply->anonymous ? 'A' : ($reply->user ? substr($reply->user->name, 0, 1) : 'D');
        
        return response()->json([
            'success' => true,
            'reply' => [
                'id' => $reply->id,
                'body' => $reply->body,
                'anonymous' => (bool)$reply->anonymous,
                'user_name' => $userName,
                'user_initials' => $userInitials
            ]
        ]);
    }

    return back()->with('success', 'Reply posted successfully!');
}
    public function edit(ForumPost $post)
    {
        return view('forum.edit', compact('post'));
    }

    public function update(Request $request, ForumPost $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50',
            'anonymous' => 'nullable|boolean',
        ]);

        $post->update([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'tags' => $validated['tags'] ?? [],
            'anonymous' => $request->boolean('anonymous'),
        ]);

        return redirect()->route('forum.show', $post->id)
                         ->with('success', 'Discussion updated successfully!');
    }

    public function destroy(ForumPost $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('forum.index')->with('success', 'Discussion deleted successfully!');
    }

    public function toggleLike(ForumPost $post)
    {
        $user = auth()->user();

        if ($post->likes()->where('user_id', $user->id)->exists()) {
            $post->likes()->where('user_id', $user->id)->delete();
            $status = 'unliked';
        } else {
            $post->likes()->create(['user_id' => $user->id]);
            $status = 'liked';
        }

        return response()->json([
            'status' => $status,
            'likes_count' => $post->likes()->count()
        ]);
    }

    
}