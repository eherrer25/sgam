<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name','status','room_id'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
