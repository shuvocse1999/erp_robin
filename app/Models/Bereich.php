<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bereich extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function aufgabes(){
        return $this->belongsTo(Aufgabe::class);
    }

    public function questionAnswerRelation()
    {
        return $this->hasOne(QuestionAnswerRelation::class, 'question_id','id');
    }

    public function answerSheets(){
        return $this->belongsTo(AnswerSheet::class,'question_id','id');
    }
}
