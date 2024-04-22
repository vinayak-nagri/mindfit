<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audio;


class AudiosController extends Controller
{
    public function index()
    {
        $audios = Audio::all();
        $breathworkAudios = Audio::where('type', 'breathwork')->get();
        $meditationAudios = Audio::where('type', 'meditation')->get();  
        return view('audios', compact('audios','breathworkAudios','meditationAudios'));
    }

    public function store(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'title' => 'required|string',
        'type' => 'required|string',
        'description' => 'nullable|string',
    ]);
    // dd($validatedData);

    // Store the audio file
    $audioPath = $request->file('audio')->store('audio', 'public');

    // Create a new audio entry
    $audio = new Audio();
    $audio->title = $validatedData['title'];
    $audio->type = $validatedData['type'];
    $audio->description = $validatedData['description'];
    $audio->file_path = basename($audioPath);
    $audio->save();

    // Optionally, you can add a success message to the session
    return redirect()->route('audios')->with('success', 'Audio uploaded successfully.');

}



    
}

