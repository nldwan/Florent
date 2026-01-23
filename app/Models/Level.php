<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['course_id', 'name', 'order'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function sublevels()
    {
        return $this->hasMany(Sublevel::class);
    }
}
