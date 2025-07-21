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

        return back()->with('success', 'Your response has been posted!');
    }

    public function edit(ForumReply $reply)
    {
        return view('forum.reply-edit', compact('reply'));
    }

    public function update(Request $request, ForumReply $reply)
    {
        $this->authorize('update', $reply);

        $request->validate([
            'body' => 'required|string|min:3',
        ]);

        $reply->update([
            'body' => $request->body,
        ]);

        return redirect()->route('forum.show', $reply->forum_post_id)
                         ->with('success', 'Response updated successfully!');
    }

    public function destroy(ForumReply $reply)
    {
        $this->authorize('delete', $reply);
        $postId = $reply->forum_post_id;
        $reply->delete();
        return redirect()->route('forum.show', $postId)
                         ->with('success', 'Response deleted successfully!');
    }
}