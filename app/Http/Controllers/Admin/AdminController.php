<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\MoodEntry;
use App\Models\PeerMessage;
use App\Models\TherapistMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = User::where('role', 'user')->count();
        $therapistCount = User::where('role', 'therapist')->count();
        $messagesCount = TherapistMessage::count() + PeerMessage::count();
        $moodsCount = MoodEntry::count();

        $recentActivities = $this->getRecentActivities();

        // Dynamic user registrations in last 30 days
        $registrations = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(30))
            ->where('role', 'user')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $registrationLabels = $registrations->pluck('date')->map(fn($d) => Carbon::parse($d)->format('d M'));
        $registrationData = $registrations->pluck('count');

        // Mood Distribution
        $moodDistribution = MoodEntry::select('mood', DB::raw('count(*) as count'))
            ->groupBy('mood')
            ->get();

        $moodLabels = $moodDistribution->pluck('mood');
        $moodData = $moodDistribution->pluck('count');

        return view('admin.dashboard', compact(
            'userCount',
            'therapistCount',
            'messagesCount',
            'moodsCount',
            'recentActivities',
            'registrationLabels',
            'registrationData',
            'moodLabels',
            'moodData'
        ));
    }

    private function getRecentActivities()
{
    $activities = [];

    // Latest users
    $newUsers = User::where('role', 'user')
        ->orderByDesc('created_at')
        ->take(5)
        ->get();

    foreach ($newUsers as $user) {
        $activities[] = [
            'title' => 'New user registered',
            'description' => "{$user->name} ({$user->email}) joined",
            'time' => $user->created_at->diffForHumans()
        ];
    }

    // Latest mood entries
    $moods = MoodEntry::orderByDesc('created_at')
        ->take(5)
        ->get();

    foreach ($moods as $mood) {
        $activities[] = [
            'title' => 'New mood entry',
            'description' => "User#{$mood->user_id} recorded mood: \"{$mood->mood}\"",
            'time' => $mood->created_at->diffForHumans()
        ];
    }

    // Latest therapist messages
    $messages = TherapistMessage::orderByDesc('created_at')
        ->take(5)
        ->get();

    foreach ($messages as $msg) {
        $sender = $msg->from_therapist ? 'Therapist' : "User#{$msg->sender_id}";
        $activities[] = [
            'title' => 'New message',
            'description' => "$sender sent a message",
            'time' => $msg->created_at->diffForHumans()
        ];
    }

    // Limit to most recent 10 by timestamp
    usort($activities, function ($a, $b) {
        return strtotime($b['time']) <=> strtotime($a['time']);
    });

    return array_slice($activities, 0, 10);
}
}