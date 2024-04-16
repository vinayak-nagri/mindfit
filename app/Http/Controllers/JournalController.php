<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mood;

class JournalController extends Controller
{
    public function index()
    {
        $moods = Mood::all();
        return view('journal',compact('moods'));
    }
    



}
