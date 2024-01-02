<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerSheet extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
