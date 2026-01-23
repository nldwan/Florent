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
        'course_id',
        'level_id',
        'sublevel_id',
        'writing_grammar',
        'writing_translation',
        'writing_composition',
        'reading_compre',
        'reading_vocabulary',
        'listening_compre',
        'speaking_pronouncing',
        'speaking_intonation',
        'speaking_fluency',
        'final_score',
        'status',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function sublevel()
    {
        return $this->belongsTo(Sublevel::class);
    }
}
