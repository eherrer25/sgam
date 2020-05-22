<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function civil()
    {
        return $this->belongsTo(CivilStatus::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function record()
    {
        return $this->hasOne(Record::class);
    }

    public function nursings()
    {
        return $this->hasMany(UserResidentNursing::class);
    }

}
