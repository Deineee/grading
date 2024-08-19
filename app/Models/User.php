<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_ADMIN = "ADMIN";
    const ROLE_TEACHER = "TEACHER";
    const ROLE_STUDENT = "STUDENT";

    const ROLES = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_TEACHER => 'Teacher',
        self::ROLE_STUDENT => 'Student'
    ];

    const DEFAULT = self::ROLE_TEACHER;

    public function canAccessPanel(Panel $panel): bool
    {
        return $this -> isAdmin() || $this -> isTeacher();
    }

    public function isAdmin(){
        return $this -> role === self::ROLE_ADMIN;
    }

    public function isTeacher(){
        return $this -> role === self::ROLE_TEACHER;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
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
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
