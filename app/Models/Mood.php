<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Get the journals associated with the mood.
     */
    public function journals()
    {
        return $this->hasMany(Journal::class);
    }
}
