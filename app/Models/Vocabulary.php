<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    use HasFactory;

    protected $table = 'vocabularies';

    protected $fillable = [
        'verb1',
        'verb2',
        'verb3',
        'meaning',
    ];
}
