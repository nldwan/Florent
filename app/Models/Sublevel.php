<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sublevel extends Model
{
    protected $fillable = ['level_id', 'order'];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}
