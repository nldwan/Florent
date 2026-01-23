<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'course_id',
        'level_id',
        'sublevel_id',
        'title',
        'file',
    ];

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
