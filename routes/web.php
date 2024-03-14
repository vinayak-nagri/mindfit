<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AffirmationsController;

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
    // Route::get('/affirmations', [AffirmationsController::class, 'affirmations'])->name('affirmations');
    Route::get('/affirmations', [AffirmationsController::class, 'index'])->name('affirmations');
    Route::post('/upload-image', [AffirmationsController::class, 'uploadImage'])->name('upload.image');
    Route::post('/save-favorite/{affirmationId}', [AffirmationsController::class, 'saveFavoriteAffirmation'])->name('save.favorite.affirmation');
    // Route::get('/affirmations', [AffirmationsController::class, 'savedAffirmations'])->name('saved.affirmations');
    // Route::get('/affirmations/saved', [AffirmationsController::class, 'savedAffirmations'])->name('saved.affirmations');

    
});

require __DIR__.'/auth.php';
