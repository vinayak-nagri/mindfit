<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AffirmationsController;
use App\Http\Controllers\HabitTrackerController;
use App\Http\Controllers\JournalController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::post('/upload-image', [AffirmationsController::class, 'uploadImage'])->middleware(['auth', 'admin'])->name('upload.image');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/affirmations', [AffirmationsController::class, 'index'])->name('affirmations');
    Route::post('/upload-image', [AffirmationsController::class, 'uploadImage'])->name('upload.image');
    Route::post('/save-favorite/{affirmationId}', [AffirmationsController::class, 'saveFavoriteAffirmation'])->name('save.favorite.affirmation');
    Route::get('/habit-tracker', [HabitTrackerController::class, 'index'])->name('habit.tracker');
    Route::post('/habits', [HabitTrackerController::class, 'store'])->name('habits.store');
    Route::put('/habits/update-habits', [HabitTrackerController::class, 'updateHabits'])->name('habits.update');
    Route::post('/habits/deactivate', [HabitTrackerController::class, 'deactivateHabit'])->name('habits.deactivate');
    Route::post('/habits/reactivate', [HabitTrackerController::class, 'reactivateHabit'])->name('habits.reactivate');
    Route::get('/habits/week', [HabitTrackerController::class, 'showWeek'])->name('habits.showWeek');
    Route::get('/journal', [JournalController::class, 'index'])->name('journal.index');
    // Route::get('/journal/mood', [JournalController::class, 'mood'])->name('journal.mood');


    
    
});

require __DIR__.'/auth.php';
