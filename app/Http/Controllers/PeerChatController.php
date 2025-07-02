<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PeerMessage;
use Illuminate\Support\Facades\Auth;

class PeerChatController extends Controller
{
    // View the group chat
    public function index()
    {
        $messages = PeerMessage::whereNull('receiver_id') // group messages only
                    ->with('user')->latest()->take(100)->get()->reverse();

        $peers = User::where('role', 'user')->get();

        return view('community.ask-peer', compact('messages', 'peers'));
    }

    // Send message to group
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        PeerMessage::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'receiver_id' => null, // null = group
        ]);

        return redirect()->route('peer.group');
    }

    // View DM with a peer
    public function privateChat($id)
    {
        $peers = User::where('role', 'user')->get();
        $receiver = User::findOrFail($id);

        $messages = PeerMessage::where(function ($q) use ($id) {
            $q->where('user_id', Auth::id())->where('receiver_id', $id);
        })->orWhere(function ($q) use ($id) {
            $q->where('user_id', $id)->where('receiver_id', Auth::id());
        })->with('user')->orderBy('created_at')->get();

        return view('community.peer-dm', compact('messages', 'peers', 'receiver'));
    }

    // Send message to peer privately
    public function sendPrivate(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        PeerMessage::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'receiver_id' => $id,
        ]);

        return redirect()->route('peer.dm', $id);
    }
}
