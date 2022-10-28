<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annotation extends Model
{
    use HasFactory;

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    public function illustration()
    {
        return $this->belongsTo(Illustration::class);
    }
}
