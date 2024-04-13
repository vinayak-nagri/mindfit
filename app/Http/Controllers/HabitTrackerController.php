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
        // $habits = HabitTracker::all();
        
        $user = Auth::user();
        $habits = HabitTracker::where('user_id', $user->id)->get();
        $inactiveHabits = $habits->where('is_active', 0);
        $weekStartDates = HabitTracker::distinct('week_start_date')->pluck('week_start_date')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('Y-m-d');
        });


        
        // $currentDate = Carbon::now();
        // $currentWeekStart = $currentDate->startOfWeek();
        // $currentWeekEnd = $currentDate->endOfWeek();

        // ->format('Y-m-d')
        

        foreach ($habits as $habit) { 
            $existingRecord = HabitTracker::where('user_id', $user->id)
                    ->where('habit_name', $habit->habit_name)
                    ->where('week_start_date', Carbon::now()->startOfWeek())
                    ->exists();

            if ($habit->week_start_date != Carbon::now()->startOfWeek() && !$existingRecord && $habit->is_active) 
            {                
                // if ($habit->week_start_date != Carbon::now()->startOfWeek())
                // dd($habit);
                // dd($habit->week_start_date == Carbon::now()->startOfWeek());
                // dd(($habit -> is_active));
                DB::table('habit_tracker') -> insert ([
                    'user_id' => $user->id,
                    'habit_name' => $habit->habit_name,
                    'week_start_date' => Carbon::now()->startOfWeek(),
                    'week_end_date' => Carbon::now()->endOfWeek(),
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        $habits = HabitTracker::where('user_id', $user->id)->get();

        foreach($habits as $key => $habit) {
            if($habit -> week_start_date != Carbon::now()->startOfWeek() || $habit-> is_active == 0 )
            {
                unset($habits[$key]);
            }
        }

        
            return view('habit-tracker', compact('habits','inactiveHabits','weekStartDates'));  
        }
        

        // Pass the habits to the view
        // return view('habit-tracker', compact('habits'));
        // return view('habit-tracker');
    

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
    // dd($request);
    $user = Auth::user();

   
    $habitIds = array_keys($request->input('habits'));
    // dd($habitIds);
    
    $habits = HabitTracker::whereIn('id', $habitIds)
                           ->where('user_id', $user->id)
                           ->get();
    // dd($habits);
    // Update each habit based on the request data
    $days = [
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
      ];

    $habits1 = HabitTracker::where('user_id', $user->id)->get();
    
    foreach ($habits1 as $habit) {
        foreach ($days as $day) {
            $habit->$day = false;
        }
        $habit->save();
    }


    // dd($habits1);
    foreach ($habits as $habit) {
        foreach ($request->input('habits')[$habit->id] as $day => $isChecked) {
            if ($isChecked === 'on') {
                $habit->$day = true;
            }
            
            // $habit->$day = $isChecked === 'on'; // Set habit property based on checkbox value
        }
        $habit->save();
    }


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

        // return response()->json(['message' => 'Habit deactivated successfully'], 200);
    }

    public function reactivateHabit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'habit_id' => 'required|exists:habit_tracker,id',
        ]);
    
        // Get the habit to reactivate
        $habit = HabitTracker::findOrFail($request->habit_id);

        if ($habit->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        // Reactivate the habit by setting is_active to 1
        $habit->update(['is_active' => 1]);
    
        // Redirect back to the habit tracker page with a success message
        return redirect()->route('habit.tracker')->with('success', 'Habit reactivated successfully.');
    }

    // public function showWeek(Request $request)
    // {
    //     $userId = Auth::id();
    //     $selectedWeek = $request->input('week');
        
    //     // Retrieve habits for the selected week
    //     $habitsForWeek = HabitTracker::where('week_start_date', $selectedWeek)->where('user_id', $userId)
    //     ->get();
    //     // You can also pass $selectedWeek to your view if needed

    //     return view('habit-tracker', compact('habitsForWeek'));
    // }


    public function showWeek(Request $request)
{
    
    $userId = Auth::id();
    $selectedWeek = $request->input('week');
    
    // Retrieve habits for the selected week
    $habitsForWeek = HabitTracker::where('week_start_date', $selectedWeek)
                                  ->where('user_id', $userId)
                                  ->get();
    // dd($habitsForWeek);
    // You can also pass $selectedWeek to your view if needed

    return view('habit-tracker', compact('habitsForWeek'));
}

}
