<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TherapistMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TherapistChatController extends Controller
{
    // Show the chat interface
    public function index()
    {
        $therapist = User::where('role', 'therapist')->first();
        
        if (!$therapist) {
            return redirect()->back()->with('error', 'No therapist available');
        }
        
        $userId = Auth::id();

        // Check if first visit already selected
        $firstVisitSelected = TherapistMessage::where('sender_id', $userId)
            ->whereNotNull('first_visit')
            ->exists();

        $messages = TherapistMessage::where(function ($query) use ($userId, $therapist) {
                $query->where('sender_id', $userId)
                    ->where('receiver_id', $therapist->id);
            })->orWhere(function ($query) use ($userId, $therapist) {
                $query->where('sender_id', $therapist->id)
                    ->where('receiver_id', $userId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('community.therapist-chat', compact('messages', 'therapist', 'firstVisitSelected'));
    }

    // Handle first visit selection
    public function setFirstVisit(Request $request)
    {
        $request->validate([
            'first_visit' => 'required|in:voice,video,physical'
        ]);

        $userId = auth()->id();
        $therapist = User::where('role', 'therapist')->first();

        if (!$therapist) {
            return response()->json(['status' => 'error', 'message' => 'Therapist not found'], 404);
        }

        TherapistMessage::create([
            'sender_id' => $userId,
            'receiver_id' => $therapist->id,
            'message' => 'First visit method selected: '.ucfirst($request->first_visit),
            'first_visit' => $request->first_visit,
            'from_therapist' => false,
            'is_read' => false,
        ]);

        return response()->json(['status' => 'success']);
    }

    // Handle sending a message
    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $userId = Auth::id();
        $therapist = User::where('role', 'therapist')->first();

        TherapistMessage::create([
            'sender_id' => $userId,
            'receiver_id' => $therapist->id,
            'message' => $request->message,
            'from_therapist' => false,
            'is_read' => false,
        ]);

        return redirect()->route('therapist.chat')->with('success', 'Message sent!');
    }

    public function chatWithUser($userId)
    {
        $therapistId = auth()->id();
        $users = User::where('role', 'user')->get();

        // Count unread messages from each user
        $unreadCounts = DB::table('therapist_messages')
            ->select('sender_id', DB::raw('COUNT(*) as count'))
            ->where('receiver_id', $therapistId)
            ->where('from_therapist', false)
            ->where('is_read', false)
            ->groupBy('sender_id')
            ->pluck('count', 'sender_id');

        // Get the selected user
        $selectedUser = User::findOrFail($userId);

        // Fetch messages
        $messages = TherapistMessage::where(function ($query) use ($therapistId, $userId) {
            $query->where('sender_id', $therapistId)->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($therapistId, $userId) {
            $query->where('sender_id', $userId)->where('receiver_id', $therapistId);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        // Mark messages as read
        TherapistMessage::where('receiver_id', $therapistId)
            ->where('sender_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('community.therapist-panel', compact('users', 'messages', 'selectedUser', 'unreadCounts'));
    }

    public function sendToUserJson(Request $request, $userId)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $message = TherapistMessage::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $userId,
            'message' => $request->message,
            'from_therapist' => true,
            'is_read' => false
        ]);

        return response()->json(['status' => 'sent', 'message' => $message]);
    }

    public function fetchMessages($userId)
    {
        $therapistId = auth()->id();

        $messages = TherapistMessage::where(function ($query) use ($therapistId, $userId) {
            $query->where('sender_id', $therapistId)->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($therapistId, $userId) {
            $query->where('sender_id', $userId)->where('receiver_id', $therapistId);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        return response()->json($messages);
    }

    public function panel()
    {
        $users = User::where('role', 'user')->get();
        $selectedUser = null;
        return view('community.therapist-panel', compact('users', 'selectedUser'));
    }

    public function sendConclusion(Request $request, $userId)
    {
        $request->validate([
            'conclusion' => 'required|string|max:3000'
        ]);

        TherapistMessage::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $userId,
            'message' => $request->conclusion,
            'from_therapist' => true,
            'is_read' => false,
            'is_conclusion' => true,
        ]);

        return redirect()->route('therapist.chat.with', $userId)->with('success', 'Conclusion saved.');
    }
}