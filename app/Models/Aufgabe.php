<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aufgabe extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function bereiches(){
        return $this->hasMany(Bereich::class);
    }

}
