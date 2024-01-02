<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswerSubmission extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function aufgabens(){
        return $this->belongsTo(Aufgabe::class,'aufgaben_id','id');
    }
    public function bereiches(){
        return $this->belongsTo(Bereich::class,'bereich_id','id');
    }

    public function answersheet(){
        return $this->belongsTo(AnswerSheet::class,'answer_sheet_id','id');
    }

    public function answers(){
        return $this->belongsTo(Answer::class,'answer_id','id');
    }
}
