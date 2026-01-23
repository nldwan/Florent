<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'video',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
