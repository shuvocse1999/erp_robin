<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessungerList extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function messunger()
    {
        return $this->belongsTo(Messunger::class);
    }

}
