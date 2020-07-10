<?php

namespace App;

use App\Events\NotificationsEvent;
use App\Models\Office;
use App\Models\Resident;
use App\Models\UserResidentNursing;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    public function getFullNameAttribute() {
        return ucfirst($this->name) . ' ' . ucfirst($this->last_name);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function nursings()
    {
        return $this->hasMany(UserResidentNursing::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','last_name','status', 'email', 'password','office_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
