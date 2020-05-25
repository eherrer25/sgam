<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $fillable = [
        'name','last_name','run','phone','mobile', 'email', 'address','commune_id'
    ];

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

}
