<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $fillable = [
        'name','last_name','run','gender','birth_of_date', 'studies', 'profession','client_id','civil_id','room_id'
    ];

    public function getFullNameAttribute() {
        return ucfirst($this->name) . ' ' . ucfirst($this->last_name);
    }


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

    public function bed()
    {
        return $this->belongsTo(Bed::class);
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
