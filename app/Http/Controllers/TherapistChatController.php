<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TherapistMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TherapistChatController extends Controller
{
    // Show the chat interface
    public function index()
    {
        $userId = Auth::id();
        $therapistId = 1;

        // Get messages where the current user is either sender or receiver
        $messages = TherapistMessage::where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                      ->orWhere('receiver_id', $userId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('community.therapist-chat', compact('messages','therapistId'));
    }

    // Handle sending a message
 public function send(Request $request)
{
    $request->validate([
        'message' => 'required|string|max:1000'
    ]);

    $userId = Auth::id(); // user is logged in
    $therapist = User::where('role', 'therapist')->first(); // assuming only one therapist

    if (!$therapist) {
        return redirect()->back()->with('error', 'No therapist available at the moment.');
    }

    TherapistMessage::create([
    'sender_id' => auth()->id(),
    'receiver_id' => $therapistId,
    'message' => $request->message,
    'from_therapist' => false,
    'is_read' => false,
]);

    return redirect()->route('therapist.chat')->with('success', 'Message sent!');
}


public function chatWithUser($userId)
{
    $therapistId = auth()->id(); // currently logged-in therapist

    
$users = User::where('role', 'user')->get();

// Count unread messages from each user
$unreadCounts = DB::table('therapist_messages')
    ->select('sender_id', DB::raw('COUNT(*) as count'))
    ->where('receiver_id', auth()->id()) // therapist is the receiver
    ->where('from_therapist', false)     // only messages from user
    ->where('is_read', false)
    ->groupBy('sender_id')
    ->pluck('count', 'sender_id'); // gives: [user_id => count]


    // Get the messages between the therapist and the selected user
    $selectedUser = User::findOrFail($userId); // Find the selected user

    // Fetch messages
    $messages = TherapistMessage::where(function ($query) use ($therapistId, $userId) {
        $query->where('sender_id', $therapistId)->where('receiver_id', $userId);
    })->orWhere(function ($query) use ($therapistId, $userId) {
        $query->where('sender_id', $userId)->where('receiver_id', $therapistId);
    })
    ->orderBy('created_at', 'asc')
    ->get();

   return view('community.therapist-panel', compact('users', 'messages', 'selectedUser', 'unreadCounts'));
}

public function fetchUserMessages($therapistId)
{
    $userId = auth()->id();

    $messages = TherapistMessage::where(function ($query) use ($userId, $therapistId) {
            $query->where('sender_id', $userId)->where('receiver_id', $therapistId);
        })
        ->orWhere(function ($query) use ($userId, $therapistId) {
            $query->where('sender_id', $therapistId)->where('receiver_id', $userId);
        })
        ->orderBy('created_at', 'asc')
        ->get();

    return response()->json($messages);
}


public function sendToUser(Request $request, $userId)
{
    $request->validate([
        'message' => 'required|string|max:1000'
    ]);

   TherapistMessage::create([
    'sender_id' => auth()->id(),
    'receiver_id' => $userId,
    'message' => $request->message,
    'from_therapist' => true,
    'is_read' => true, // therapist messages are always "read" to the user side logic
]);


    return redirect()->route('therapist.chat.with', $userId)->with('success', 'Message sent.');
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
    $users = User::where('role', 'user')->get(); // All users that therapist can talk to

    $selectedUser= null;
    return view('community.therapist-panel', compact('users', 'selectedUser'));
}

}
