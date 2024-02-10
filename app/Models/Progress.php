<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'game_id', 'level', 'level_content', 'fails'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
