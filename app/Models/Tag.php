<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = ['name'];

    public function journalEntries()
    {
        return $this->belongsToMany(Journal::class, 'journal_tag', 'tag_id', 'journal_id');
    }
}
