<?php

namespace App\Http\Controllers;

use App\Models\HabitTracker;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HabitTrackerController extends Controller
{
    public function index()
    {
        // $habits = HabitTracker::all();
        $user = Auth::user();
        $habits = HabitTracker::where('user_id', $user->id)->get();

        // Pass the habits to the view
        return view('habit-tracker', compact('habits'));
        // return view('habit-tracker');
    }

    public function store(Request $request)
{
    // Validate the form data
    $request->validate([
        'name' => 'required|string|max:50',
    ]);

    // Get the current date
    $currentDate = Carbon::now();

    $habit = new HabitTracker();
    $habit -> week_start_date = $currentDate->startOfWeek();
    $habit -> week_end_date = $currentDate->endOfWeek();

    $habit->habit_name = $request->input('name');
    $habit->user_id = auth()->id(); // Assuming user authentication is implemented

    // $habit->monday = $request->has('monday');
    // $habit->tuesday = $request->has('tuesday');
    // $habit->wednesday = $request->has('wednesday');
    // $habit->thursday = $request->has('thursday');
    // $habit->friday = $request->has('friday');
    // $habit->saturday = $request->has('saturday');
    // $habit->sunday = $request->has('sunday');

    // Save the habit
    $habit->save();

    // Redirect back to the habit tracker page with a success message
    return redirect()->route('habit.tracker')->with('success', 'Habit added successfully.');
}

public function updateHabits(Request $request)
{

    $user = Auth::user();
    
    // Retrieve the habits for the logged-in user
    $habits = HabitTracker::where('user_id', $user->id)->get();

    // Loop through each habit
    foreach ($habits as $habit) {
        // Update the checkboxes based on the request data
        $habit->monday = $request->has('monday');
        $habit->tuesday = $request->has('tuesday');
        $habit->wednesday = $request->has('wednesday');
        $habit->thursday = $request->has('thursday');
        $habit->friday = $request->has('friday');
        $habit->saturday = $request->has('saturday');
        $habit->sunday = $request->has('sunday');

        // Save the updated habit
        $habit->save();
    }

    // Redirect back to the habit tracker page with a success message
    return redirect()->route('habit.tracker')->with('success', 'Habits updated successfully.');

}

}
