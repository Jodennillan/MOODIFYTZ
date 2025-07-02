<?php

namespace App\Http\Controllers;

use App\Models\MoodEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoodEntryController extends Controller
{
    public function index()
    {
        $entries = MoodEntry::where('user_id', Auth::id())
                    ->orderByDesc('entry_date')
                    ->get();
        return view('mood.index', compact('entries'));
    }

    public function create()
    {
        return view('mood.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mood' => 'required|string',
            'intensity' => 'nullable|string',
            'reason' => 'nullable|string',
            'entry_date' => 'required|date',
        ]);

        MoodEntry::create([
            'user_id' => Auth::id(),
            'mood' => $request->mood,
            'intensity' => $request->intensity,
            'reason' => $request->reason,
            'entry_date' => $request->entry_date,
        ]);

        return redirect()->route('mood.index')->with('success', 'Mood logged successfully!');
    }
}
