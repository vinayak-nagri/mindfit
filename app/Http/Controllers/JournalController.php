<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mood;
use App\Models\Journal;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class JournalController extends Controller
{
    public function index()
    {

        $moods = Mood::all();
        $journalEntries = Journal::where('user_id', auth()->id())->get();
        return view('journal',compact('moods','journalEntries'));
    }
    


    public function store(Request $request)
    {
        // dd($request);
    // Validate the incoming request data
        $validatedData = $request->validate([
        'journal_entry' => 'required|string',
        'mood_id' => 'required|exists:moods,id',
        'tags' => 'nullable|string',
        ]);
    
    // dd($request);
    
    // Create a new journal entry
        $journal = new Journal();
        $journal->user_id = Auth::id();
        $journal->entry_text = $validatedData['journal_entry'];
        $journal->mood_id = $validatedData['mood_id'];
        $journal->week_start_date = Carbon::now()->startOfWeek();
        
        
        $journal->save();

    // Process and attach tags
        if ($request->has('tags')) {
            $tags = explode(',', $validatedData['tags']);
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $journal->tags()->attach($tag->id);
            }
        }

    // Redirect back with a success message
    return redirect()->route('journal.index')->with('success', 'Journal entry added successfully.');
    }



}
