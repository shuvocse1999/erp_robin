<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formular extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function aufgabes()
    {
        return $this->hasMany(Aufgabe::class);
    }

    public function submissions()
    {
        return $this->hasMany(AnswerSubmission::class, 'formular_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
