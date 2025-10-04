<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vocabularies extends Model
{
    use HasFactory;

    protected $fillable = [
        'word',
        'type',
        'verb2',
        'verb3',
        'meaning',
    ];
}
