<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AffirmationsController;
use App\Http\Controllers\HabitTrackerController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\AudiosController;



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
    //Affirmation Routes
    Route::get('/affirmations', [AffirmationsController::class, 'index'])->name('affirmations');
    Route::post('/upload-image', [AffirmationsController::class, 'uploadImage'])->name('upload.image');
    Route::post('/save-favorite/{affirmationId}', [AffirmationsController::class, 'saveFavoriteAffirmation'])->name('save.favorite.affirmation');
    //Habit Tracker Routes
    Route::get('/habit-tracker', [HabitTrackerController::class, 'index'])->name('habit.tracker');
    Route::post('/habits', [HabitTrackerController::class, 'store'])->name('habits.store');
    Route::put('/habits/update-habits', [HabitTrackerController::class, 'updateHabits'])->name('habits.update');
    Route::post('/habits/deactivate', [HabitTrackerController::class, 'deactivateHabit'])->name('habits.deactivate');
    Route::post('/habits/reactivate', [HabitTrackerController::class, 'reactivateHabit'])->name('habits.reactivate');
    Route::get('/habits/week', [HabitTrackerController::class, 'showWeek'])->name('habits.showWeek');
    //Journal Routes
    Route::get('/journal', [JournalController::class, 'index'])->name('journal.index');
    // Route::get('/journal/mood', [JournalController::class, 'mood'])->name('journal.mood');
    Route::post('/journal/store', [JournalController::class, 'store'])->name('journal.store');
    Route::get('/journal/search', [JournalController::class, 'search'])->name('journal.search');
    Route::delete('/journal/delete/{id}', [JournalController::class, 'delete'])->name('journal.delete');
    Route::get('/journal/edit/{id}', [JournalController::class, 'edit'])->name('journal.edit');
    Route::put('/journal/update/{id}', [JournalController::class, 'update'])->name('journal.update');
    //Audios Routes
    Route::get('/audios', [AudiosController::class, 'index'])->name('audios');
    Route::post('/audios/store', [AudiosController::class, 'store'])->name('audios.store');









    
    
});

require __DIR__.'/auth.php';
