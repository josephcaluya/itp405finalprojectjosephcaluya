<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cafe;
use App\Models\User;

class Review extends Model
{
    public function cafe()
    {
        return $this->belongsTo(Cafe::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
