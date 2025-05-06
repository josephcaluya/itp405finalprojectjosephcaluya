<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    public function cafe()
    {
        return $this->belongsTo(Cafe::class);
    }
}
