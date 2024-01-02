<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerSubmission extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function userId(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function formulars(){
        return $this->belongsTo(Formular::class,'formular_id','id');
    }

    public function userAnswers(){
        return $this->hasMany(UserAnswerSubmission::class,'answer_submissions_id','id');
    }
}
