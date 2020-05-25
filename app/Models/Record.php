<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
