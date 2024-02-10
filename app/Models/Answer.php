<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'question_id', 'answer'];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
