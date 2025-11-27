<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
<<<<<<< HEAD
use Laravel\Sanctum\HasApiTokens;
=======
>>>>>>> 5270ef75c682166a1e9125b37f7f4c1d16bafa49

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
<<<<<<< HEAD
    use HasFactory, Notifiable,HasApiTokens;
=======
    use HasFactory, Notifiable;
>>>>>>> 5270ef75c682166a1e9125b37f7f4c1d16bafa49

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
<<<<<<< HEAD
    public function user()
    {
        return $this->morphTo();
    }


=======
>>>>>>> 5270ef75c682166a1e9125b37f7f4c1d16bafa49
}
