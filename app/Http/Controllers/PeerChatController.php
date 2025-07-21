<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PeerMessage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PeerChatController extends Controller
{
    // View group chat
    public function index()
    {
        $messages = PeerMessage::whereNull('receiver_id')
                    ->with('user')
                    ->latest()
                    ->take(100)
                    ->get()
                    ->reverse();

        // Get online peers (active in last 3 minutes)
        $peers = User::where('role', 'user')
                    ->where('id', '!=', auth()->id())
                    ->get()
                    ->map(function ($user) {
                        $user->is_online = $user->last_seen && $user->last_seen > now()->subMinutes(3);
                        return $user;
                    });

        return view('community.group-chat', compact('messages', 'peers'));
    }

    // Send group message
    public function sendMessage(Request $request)
    {
        $request->validate(['message' => 'required|string|max:1000']);

        PeerMessage::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'receiver_id' => null,
        ]);

        // Update user's last seen
        Auth::user()->update(['last_seen' => now()]);

        return redirect()->route('peer.group');
    }

    // View DM chat
    public function privateChat($id)
    {
        $receiver = User::findOrFail($id);
        
        // Get online peers
        $peers = User::where('role', 'user')
                    ->where('id', '!=', auth()->id())
                    ->get()
                    ->map(function ($user) {
                        $user->is_online = $user->last_seen && $user->last_seen > now()->subMinutes(3);
                        return $user;
                    });

        $messages = PeerMessage::where(function ($q) use ($id) {
            $q->where('user_id', Auth::id())->where('receiver_id', $id);
        })->orWhere(function ($q) use ($id) {
            $q->where('user_id', $id)->where('receiver_id', Auth::id());
        })->with('user')->orderBy('created_at')->get();

        return view('community.dm-peer', compact('messages', 'receiver', 'peers'));
    }

    // Send private message
    public function sendPrivate(Request $request, $id)
    {
        $request->validate(['message' => 'required|string|max:1000']);

        PeerMessage::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'receiver_id' => $id,
        ]);

        // Update user's last seen
        Auth::user()->update(['last_seen' => now()]);

        return redirect()->route('peer.dm', $id);
    }
}