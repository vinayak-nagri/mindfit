<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audio;


class AudiosController extends Controller
{
    public function index()
    {
        // Retrieve all audio files
        $audios = Audio::all();

        // Retrieve breathwork audios
        $breathworkAudios = Audio::where('type', 'breathwork')->get();

        // Retrieve meditation audios
        $meditationAudios = Audio::where('type', 'meditation')->get();  

        // Return the view with the audio data
        return view('audios', compact('audios','breathworkAudios','meditationAudios'));
    }

    
    //The following function is for the author to upload audio files and is
    //not accessible during regular operation of the website.
    public function store(Request $request)
    {
    // Validate the incoming request data
    $validatedData = $request->validate([
        'title' => 'required|string',
        'type' => 'required|string',
        'description' => 'nullable|string',
    ]);
    

    // Store the audio file
    $audioPath = $request->file('audio')->store('audio', 'public');

    // Create a new audio entry
    $audio = new Audio();
    $audio->title = $validatedData['title'];
    $audio->type = $validatedData['type'];
    $audio->description = $validatedData['description'];
    $audio->file_path = basename($audioPath);
    $audio->save();

    
    return redirect()->route('audios')->with('success', 'Audio uploaded successfully.');

    }



    
}

