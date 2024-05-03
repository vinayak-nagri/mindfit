<?php

namespace App\Http\Controllers;

use App\Models\HabitTracker;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Log;
use DB;

class HabitTrackerController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Retrieve all habits associated with the authenticated user
        $habits = HabitTracker::where('user_id', $user->id)->get();

        // Filter out inactive habits
        $inactiveHabits = $habits->where('is_active', 0);

        // Retrieve distinct week start dates from habit tracker records
        $weekStartDates = HabitTracker::distinct('week_start_date')->pluck('week_start_date')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('Y-m-d');
        });
        
        // Check and insert new habit records for the current week if they don't already exist
        foreach ($habits as $habit) {
            // Check if a record exists for the habit for the current week
            $existingRecord = HabitTracker::where('user_id', $user->id)
                    ->where('habit_name', $habit->habit_name)
                    ->where('week_start_date', Carbon::now()->startOfWeek())
                    ->exists();

            // If the habit is active and no record exists, insert a new record for the current week                    
            if ($habit->week_start_date != Carbon::now()->startOfWeek() && !$existingRecord && $habit->is_active) 
            {                
                DB::table('habit_tracker') -> insert ([
                    'user_id' => $user->id,
                    'habit_name' => $habit->habit_name,
                    'week_start_date' => Carbon::now()->startOfWeek(),
                    'week_end_date' => Carbon::now()->endOfWeek(),
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        // Retrieve habits for the current week
        $habits = HabitTracker::where('user_id', $user->id)->get();


        // Filter out habits that are not for the current week or are inactive
        foreach($habits as $key => $habit) {
            if($habit -> week_start_date != Carbon::now()->startOfWeek() || $habit-> is_active == 0 )
            {
                unset($habits[$key]);
            }
        }
            // Return the habit tracker view with relevant data
            return view('habit-tracker', compact('habits','inactiveHabits','weekStartDates'));  
        }
        

    

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        // Get the current date
        $currentDate = Carbon::now();

        // Create a new instance of the HabitTracker model
        $habit = new HabitTracker();

        // Set the start and end dates of the current week
        $habit -> week_start_date = $currentDate->startOfWeek();
        $habit -> week_end_date = $currentDate->endOfWeek();
        
        // Set the habit name and user ID
        $habit->habit_name = $request->input('name');
        $habit->user_id = auth()->id();
    
        // Save the habit
        $habit->save();

        // Redirect back to the habit tracker page with a success message
        return redirect()->route('habit.tracker')->with('success', 'Congratulations! Your new habit has been successfully logged. Keep up the momentum and watch your progress soar!');
    }

// public function updateHabits(Request $request)
// {
//     $user = Auth::user();
//     // Retrieve the habits for the logged-in user
//     $habits = HabitTracker::where('user_id', $user->id)->get();
//     //Loop through each habit
//     foreach ($habits as $habit) {
//         // Update the checkboxes based on the request data

//         $habit->monday = $request->get('monday') == 'on';
//         $habit->tuesday = $request->has('tuesday');
//         $habit->wednesday = $request->has('wednesday');
//         $habit->thursday = $request->has('thursday');
//         $habit->friday = $request->has('friday');
//         $habit->saturday = $request->has('saturday');
//         $habit->sunday = $request->has('sunday');

//         // Save the updated habit
//         $habit->save();
//     }


//     // Redirect back to the habit tracker page with a success message
//     return redirect()->route('habit.tracker')->with('success', 'Habits updated successfully.');

// }

public function updateHabits(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Extract the habit IDs from the request
        $habitIds = array_keys($request->input('habits'));

        // Fetch the habits associated with the extracted IDs
        $habits = HabitTracker::whereIn('id', $habitIds)
                            ->where('user_id', $user->id)
                            ->get();

        // Reset all habit checkboxes for the user
        $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
        $habits1 = HabitTracker::where('user_id', $user->id)->get();
        foreach ($habits1 as $habit) {
            foreach ($days as $day) {
                $habit->$day = false;
            }
            $habit->save();
        }

        // Update the habits based on the request data
        foreach ($habits as $habit) {
            foreach ($request->input('habits')[$habit->id] as $day => $isChecked) {
                if ($isChecked === 'on') {
                    $habit->$day = true;
                }
            }
            $habit->save();
    }
    // Redirect back to the habit tracker page with a success message
    return redirect()->route('habit.tracker')->with('success', 'Habits updated successfully.');
    }

    public function deactivateHabit(Request $request)
        {
            // Validate the request data
            $request->validate([
                'habit_id' => 'required|exists:habit_tracker,id'
            ]);

            // Find the habit
            $habit = HabitTracker::findOrFail($request->input('habit_id'));

            // Ensure that the habit belongs to the current user
            if ($habit->user_id !== Auth::id()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            // Deactivate the habit
            $habit->update(['is_active' => 0]);

            // Return a success response
            return redirect()->route('habit.tracker')->with('success', 'Habit deactivated successfully.');
        }

    public function reactivateHabit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'habit_id' => 'required|exists:habit_tracker,id',
        ]);
    
        // Get the habit to reactivate
        $habit = HabitTracker::findOrFail($request->habit_id);

        // Return an unauthorized response if the authenticated user is not the owner of the habit
        if ($habit->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        // Reactivate the habit by setting is_active to 1
        $habit->update(['is_active' => 1]);
    
        // Redirect back to the habit tracker page with a success message
        return redirect()->route('habit.tracker')->with('success', 'Habit reactivated successfully.');
    }

    public function showWeek(Request $request)
{
    // Get the authenticated user's ID
    $userId = Auth::id();

    // Retrieve the selected week from the request
    $selectedWeek = $request->input('week');
    
    // Retrieve habits for the selected week belonging to the authenticated user
    $habitsForWeek = HabitTracker::where('week_start_date', $selectedWeek)
                                  ->where('user_id', $userId)
                                  ->get();
    
    // Return the habit tracker view with habits for the selected week
    return view('habit-tracker', compact('habitsForWeek'));
}

}
