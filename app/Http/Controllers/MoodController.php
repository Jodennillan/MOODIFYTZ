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
        $hour = Carbon::now()->hour;
        $timePeriod = match (true) {
            $hour >= 5 && $hour < 11  => 'morning',
            $hour >= 11 && $hour < 17 => 'afternoon',
            $hour >= 17 && $hour < 21 => 'evening',
            default                   => 'night',
        };

        $prompt = match ($timePeriod) {
            'morning'   => '🌅 How was your morning?',
            'afternoon' => '☀️ How is your day going?',
            'evening'   => '🌇 How are you feeling this evening?',
            default     => '🌙 Reflecting before bed?',
        };

        return view('mood.create', compact('prompt', 'timePeriod'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mood' => 'required',
            'note' => 'nullable|string|max:1000',
            'time_period' => 'required',
            'intensity' => 'nullable|string',
            'entry_date' => 'required|date',
        ]);

        MoodEntry::create([
            'user_id'     => auth()->id(),
            'mood'        => $request->mood,
            'note'        => $request->note,
            'time_period' => $request->time_period,
            'intensity' => $request->intensity,
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

