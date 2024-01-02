<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswerRelation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function answers(){
        return $this->hasMany(Answer::class,'answer_sheet_id','answer_sheet_id');
    }

    public function answer_sheet(){
        return $this->belongsTo(AnswerSheet::class,'answer_sheet_id','id');
    }
}
