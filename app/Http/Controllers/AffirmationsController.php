<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Affirmation;
use Illuminate\Support\Facades\Auth;

class AffirmationsController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('admin', ['only' => ['uploadImage']]);
    // }

    public function index()
    {
        // Fetch affirmations from the database
        $affirmations = Affirmation::all(); // Update this based on your model and database structure
        $user = Auth::user();
        $savedAffirmations = $user->favoriteAffirmations;
        // Pass affirmations to the view
        // return view('affirmations', ['affirmations' => $affirmations]);
        return view('affirmations', ['affirmations' => $affirmations, 'savedAffirmations' => $savedAffirmations]);
    }

    // public function affirmations()
    // {
    //     return view('affirmations');
    // }

//     public function affirmations()
// // {
// //     $affirmations = Affirmation::all(); // Assuming you have an Affirmation model
// //     return view('affirmations.index', compact('affirmations'));
// // }

    public function uploadImage(Request $request)
    {
        // Validate the request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the image
        $imagePath = $request->file('image')->store('affirmation_images', 'public');

        // Save the image path to the database
        $affirmation = new Affirmation();
        $affirmation->image_path = $imagePath;
        $affirmation->save();

        return redirect()->route('affirmations')->with('success', 'Image uploaded successfully');
    }

   

    public function saveFavoriteAffirmation($affirmationId)
{
    // Get the authenticated user
    $user = Auth::user();

    // Check if the user has already favorited this affirmation
    if ($user->favoriteAffirmations()->where('affirmation_id', $affirmationId)->exists()) {
        return redirect()->route('affirmations')->with('error', 'Affirmation already favorited.');
    }

    // Find the affirmation by ID
    $affirmation = Affirmation::findOrFail($affirmationId);

    // Increment the favorite count in the affirmations table
    $affirmation->increment('favorite_count');

    // Attach the affirmation to the user's favorites
    $user->favoriteAffirmations()->attach($affirmation);

    return redirect()->route('affirmations')->with('success', 'Affirmation saved to favorites!');
}
    
    // public function savedAffirmations()
    // {
        
    //     // Get the authenticated user
    //     $user = Auth::user();

    //     // Get the user's saved affirmations
    //     $savedAffirmations = $user->favoriteAffirmations;
    //     // Pass the saved affirmations to the view
    //     // dd($savedAffirmations);
    //     return view('affirmations', ['savedAffirmations' => $savedAffirmations]);
    // }


}
