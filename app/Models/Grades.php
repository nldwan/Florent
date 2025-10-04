<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'speaking_pronouncing',
        'speaking_intonation',
        'speaking_fluency',
        'writing_grammar',
        'writing_reading',
        'writing_listening',
        'writing_vocabulary',
        'writing_translation',
        'writing_composition',
        'notes',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
