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
        $journalEntries = Journal::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
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

    public function search(Request $request)
{
    // Get the search query from the request
    $query = $request->input('search');
    // dd($query);
    // Get the logged-in user's ID
    $userId = auth()->id();
    
    // Search for journal entries belonging to the logged-in user
    $journalEntries = Journal::where('user_id', auth()->id())
        ->where(function ($q) use ($query) {
            $q->where('entry_text', 'like', "%$query%")
              ->orWhereHas('mood', function ($q) use ($query) {
                  $q->where('name', 'like', "%$query%");
              })
              ->orWhereHas('tags', function ($q) use ($query) {
                  $q->where('name', 'like', "%$query%");
              });
        })
        ->orderBy('created_at', 'desc')
        ->get();

    // $journalEntries = Journal::where('user_id', $userId)
    //     ->where('entry_text', 'like', '%' . $query . '%')
    //     ->get();

        // $brule = Journal::where('user_id', $userId)
        // ->where(function ($queryBuilder) use ($query) {
        //     $queryBuilder->where('entry_text', 'like', '%' . $query . '%');
        // })
        // ->get();

        // dd($brule);


    // Return the view with the search results
    return view('journal', compact('journalEntries'));
    // return redirect()->route('journal.search', ['journalEntries' => $journalEntries]);

}

public function delete($id)
{
    // Find the journal entry by ID
    $journalEntry = Journal::findOrFail($id);

    // Check if the logged-in user owns the journal entry
    if ($journalEntry->user_id !== auth()->id()) {
        // If not, return a 403 Forbidden response
        abort(403);
    }

    // Delete the journal entry
    $journalEntry->delete();

    // Redirect back to the journal index page with a success message
    return redirect()->route('journal.index')->with('success', 'Journal entry deleted successfully.');
}

public function edit($id)
{
    // Fetch the journal entry by its ID
    $moods = Mood::all();

    $journalEntry = Journal::findOrFail($id);

    // Pass the journal entry data to the view
    return view('journal', compact('journalEntry','moods'));
}

public function update(Request $request, $id)
{
    // Retrieve the journal entry to be updated

    
    $journalEntry = Journal::findOrFail($id);

    // Validate the incoming data
    $validatedData = $request->validate([
        'journal_entry' => 'required|string',
        'mood_id' => 'required|exists:moods,id',
        'tags' => 'nullable|string',
        // Add validation rules for other fields if needed
    ]);
    // dd($validatedData['journal_entry']);
    // Update the journal entry with the validated data
    $journalEntry->update([
        'entry_text' => $validatedData['journal_entry'],
        'mood_id' => $validatedData['mood_id'],
    ]);

    // dd($journalEntry['entry_text']);

    // Process and attach tags
    if ($request->has('tags')) {
        $tags = explode(',', $validatedData['tags']);
        $tagIds = [];
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
            $tagIds[] = $tag->id;
        }
        $journalEntry->tags()->sync($tagIds);
    } else {
        // If no tags are provided, detach all existing tags
        $journalEntry->tags()->detach();
    }

    

    // Redirect the user to the appropriate page
    return redirect()->route('journal.index')->with('success', 'Journal entry updated successfully.');;
}




}
