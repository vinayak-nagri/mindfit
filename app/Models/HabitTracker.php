<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HabitTracker extends Model
{
    use HasFactory;

    protected $table = 'habit_tracker';

    protected $fillable = [
        'habit_name',
        'week_start_date',
        'week_end_date',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'week_start_date' => 'date',
        'week_end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
