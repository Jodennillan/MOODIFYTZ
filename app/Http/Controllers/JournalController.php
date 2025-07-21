<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\JournalEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JournalController extends Controller
{
    public function create()
    {
        return view('journal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'entry_date' => 'required|date',
            'privacy' => 'required|in:private,shared'
        ]);
        
        JournalEntry::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'entry_date' => $request->entry_date,
            'privacy' => $request->privacy
        ]);
        
        return redirect()->route('journal.history')->with('success', 'Journal entry created successfully!');
    }

    public function history()
    {
        $entries = JournalEntry::where('user_id', auth()->id())
                    ->orderByDesc('entry_date')
                    ->paginate(10);
        
        // Calculate journal insights
        $totalEntries = JournalEntry::where('user_id', auth()->id())->count();
        
        $mostActiveDay = JournalEntry::where('user_id', auth()->id())
            ->select(DB::raw('DAYNAME(entry_date) as day'), DB::raw('count(*) as count'))
            ->groupBy('day')
            ->orderByDesc('count')
            ->value('day') ?? 'N/A';
        
        $longestEntry = JournalEntry::where('user_id', auth()->id())
            ->select(DB::raw('MAX(LENGTH(content) - LENGTH(REPLACE(content, " ", "")) + 1) as word_count'))
            ->value('word_count') ?? 0;

        return view('journal.history', compact(
            'entries', 
            'totalEntries',
            'mostActiveDay',
            'longestEntry'
        ));
    }

    public function edit(JournalEntry $entry)
    {
        // Ensure the user owns this entry
        if ($entry->user_id !== auth()->id()) {
            abort(403);
        }
        
        return view('journal.edit', compact('entry'));
    }

    public function update(Request $request, JournalEntry $entry)
    {
        // Ensure the user owns this entry
        if ($entry->user_id !== auth()->id()) {
            abort(403);
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'entry_date' => 'required|date',
            'privacy' => 'required|in:private,shared'
        ]);
        
        $entry->update([
            'title' => $request->title,
            'content' => $request->content,
            'entry_date' => $request->entry_date,
            'privacy' => $request->privacy
        ]);
        
        return redirect()->route('journal.history')->with('success', 'Journal entry updated successfully!');
    }

    public function destroy(JournalEntry $entry)
    {
        // Ensure the user owns this entry
        if ($entry->user_id !== auth()->id()) {
            abort(403);
        }
        
        $entry->delete();
        
        return redirect()->route('journal.history')->with('success', 'Journal entry deleted successfully!');
    }
}