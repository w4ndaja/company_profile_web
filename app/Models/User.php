<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->morphToMany(Role::class, 'roleable');
    }

    public function scopeHasRole($q, $role)
    {
        return $q->role()->whereName($role)->first();
    }

    public function scopeHasPermission($q, ...$permissions)
    {
        $inRole = $q->role()->whereHas('permissions', function ($q) use ($permissions) {
            $q->whereIn('name', $permissions);
        })->get();
        $inPermission = $q->permissions()->whereIn('name', $permissions)->get();
        if (! $inRole && ! $inPermission) {
            return false;
        } else {
            return true;
        }
    }

    public function permissions()
    {
        return $this->morphToMany(Permission::class, 'permissionable');
    }
}
