<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class AlarmResident extends Model
{
    protected $fillable = [
        'start','name','description','user_id','resident_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

}
