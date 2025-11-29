<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';

    protected $fillable = [
        'user_id',
        'writing_grammar',
        'writing_translation',
        'writing_composition',
        'reading_compre',
        'reading_vocabulary',
        'listening_compre',
        'speaking_pronouncing',
        'speaking_intonation',
        'speaking_fluency',
        'notes',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
