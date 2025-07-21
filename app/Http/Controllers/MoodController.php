<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\MoodEntry;
use Illuminate\Http\Request;

class MoodController extends Controller
{
    public function index()
    {
        $moods = MoodEntry::where('user_id', auth()->id())->latest()->take(7)->get();
        return view('mood.index', compact('moods'));
    }

    public function create()
    {
        $timePeriods = [
            'morning' => ['icon' => '🌅', 'label' => 'Morning'],
            'afternoon' => ['icon' => '☀️', 'label' => 'Afternoon'],
            'evening' => ['icon' => '🌇', 'label' => 'Evening'],
            'night' => ['icon' => '🌙', 'label' => 'Night']
        ];

        $currentPeriod = match(true) {
            Carbon::now()->hour >= 5 && Carbon::now()->hour < 11 => 'morning',
            Carbon::now()->hour >= 11 && Carbon::now()->hour < 17 => 'afternoon',
            Carbon::now()->hour >= 17 && Carbon::now()->hour < 21 => 'evening',
            default => 'night'
        };

        $moods = [
            'happy' => ['emoji' => '😊', 'label' => 'Happy', 'color' => 'bg-green-100 text-green-800'],
            'anxious' => ['emoji' => '😟', 'label' => 'Anxious', 'color' => 'bg-yellow-100 text-yellow-800'],
            'sad' => ['emoji' => '😢', 'label' => 'Sad', 'color' => 'bg-blue-100 text-blue-800'],
            'angry' => ['emoji' => '😠', 'label' => 'Angry', 'color' => 'bg-red-100 text-red-800'],
            'tired' => ['emoji' => '😴', 'label' => 'Tired', 'color' => 'bg-purple-100 text-purple-800'],
            'neutral' => ['emoji' => '😐', 'label' => 'Neutral', 'color' => 'bg-gray-100 text-gray-800']
        ];

        $triggers = [
            'work' => 'Work/Studies',
            'family' => 'Family',
            'friends' => 'Friends',
            'health' => 'Health',
            'finance' => 'Finances',
            'relationships' => 'Relationships',
            'alone_time' => 'Alone Time',
            'social' => 'Social Activity'
        ];

        return view('mood.create', compact('timePeriods', 'currentPeriod', 'moods', 'triggers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mood' => 'required',
            'note' => 'nullable|string|max:1000',
            'time_period' => 'required',
            'intensity' => 'required',
            'triggers' => 'nullable|array',
            'entry_date' => 'required|date',
        ]);

        $moodParts = explode('|', $request->mood);
        
        MoodEntry::create([
            'user_id' => auth()->id(),
            'mood' => $moodParts[0], // Full string with emoji
            'mood_value' => $moodParts[1], // Mood key
            'emoji' => $moodParts[2], // Emoji only
            'note' => $request->note,
            'time_period' => $request->time_period,
            'intensity' => $request->intensity,
            'triggers' => $request->triggers ? implode(',', $request->triggers) : null,
            'entry_date' => $request->entry_date,
        ]);

        return redirect()->route('mood.feedback')->with('success', 'Mood recorded successfully!');
    }

    public function feedback()
    {
        return view('mood.feedback');
    }

    public function history()
    {
        $moods = MoodEntry::where('user_id', auth()->id())->orderByDesc('entry_date')->get();
        return view('mood.history', compact('moods'));
    }
}