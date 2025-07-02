<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
{
    
    $posts = ForumPost::with(['replies', 'likes'])->latest()->get();

    return view('forum.index', compact('posts'));
}

    // Show the form to create a new forum post
    public function create()
    {
        return view('forum.create');
    }

    // Store a new forum post
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
                     ->with('success', 'Your post has been created!');
}


    // Display a specific forum post
    public function show($id)
    {
        $post = ForumPost::with('user')->findOrFail($id);
        
        return view('forum.show', compact('post'));
    }
    public function like(Request $request, ForumPost $post)
{
    $user = $request->user();

    if ($post->likes()->where('user_id', $user->id)->exists()) {
        // Unlike
        $post->likes()->detach($user->id);
    } else {
        // Like
        $post->likes()->attach($user->id);
    }

    return back();
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


