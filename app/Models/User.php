<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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

    // Relasi ke Profile (One-to-One)
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // Relasi ke Permohonan (One-to-Many)
    public function permohonans()
    {
        return $this->hasMany(Permohonan::class);
    }

    // Relasi ke Notifikasi (One-to-Many)
    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class);
    }
}
