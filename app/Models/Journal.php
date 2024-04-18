<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $table = 'journal_entries';

    protected $fillable = [
        'user_id',
        'entry_date',
        'entry',
        'mood_id',
    ];

    protected $dates = [
        'entry_date',
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mood()
    {
        return $this->belongsTo(Mood::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'journal_tag', 'journal_id', 'tag_id');
    }
}
