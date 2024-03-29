<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id'); //(Role::class, 'forign key', 'local key')
    }

    public function hasRole($role)
    {
        return $this->role->name == $role; //jika name sma dengan $role, hasilnya true dan kebalikannya
    }

    function bank_user() 
    {
        return $this->belongsToMany(Bank::class, 'bank_user', 'user_id')
            ->withPivot('account', 'name', 'is_main')
            ->withTimestamps();
    }
    
    public function mainAccount()
    {
        return $this->bank_user()
            ->where('is_main', 1)
            ->first();    
    }

    function scopeDonatur($query)
    {
        return $query->whereHas('role', function ($query) {
            $query->where('name', 'donatur');
        });  
    }

    function campaigns()
    {
        return $this->hasMany(Campaign::class, 'user_id', 'id');  
    }

    function donations()
    {
        return $this->hasMany(Donation::class, 'user_id', 'id');  
    }
}
