<?php

namespace App\Http\Controllers;

use App\Models\ForumReply;
use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumReplyController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'body' => 'required|string|min:3',
        ]);

        ForumReply::create([
            'forum_post_id' => $postId,
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return back()->with('success', 'Reply posted!');
    }
}
