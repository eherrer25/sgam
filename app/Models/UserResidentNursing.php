<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserResidentNursing extends Model
{
    protected $fillable = [
        'user_id','resident_id','nursing_id','start_unreal','stop_unreal', 'start', 'stop','status'
    ];

    protected $table = 'users_residents_nursings';

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
