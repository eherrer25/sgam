<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserResidentNursing extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function nursing()
    {
        return $this->belongsTo(Nursing::class);
    }
}
