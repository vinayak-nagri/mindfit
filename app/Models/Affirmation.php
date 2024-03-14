<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affirmation extends Model
{
    use HasFactory;

    protected $table = 'affirmations'; 
    protected $fillable = ['image_path', 'favorite_count'];

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'affirmation_user');
    }
}
