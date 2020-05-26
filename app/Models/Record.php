<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'name','frequency','observations','resident_id'
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
