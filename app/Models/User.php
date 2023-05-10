<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
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
    ];

    public function tasksAssignedTo()
    {
        return $this->hasMany(Task::class, 'assigned_to_id');
    }

    public function tasksAssignedBy()
    {
        return $this->hasMany(Task::class, 'assigned_by_id');
    }

    public function scopeAdmins($query)
    {
        return $query->where('is_admin', 1);
    }

    public function scopeNonAdmins($query)
    {
        return $query->where('is_admin', 0);
    }
}
