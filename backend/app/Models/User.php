<?php

namespace App\Models;

use App\Traits\HasCache;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int                          $id
 * @property bool                         $is_blocked
 * @property string                       $password
 * @property string                       $first_name
 * @property string                       $last_name
 * @property string                       $patronymic
 * @property string                       $post
 * @property string                       $email
 * @property string                       $phone
 * @property string                       $created_at
 * @property string                       $updated_at
 * @property-read Collection|Role[]       $roles
 * @property-read Collection|Permission[] $permissions
 * @property-read Collection|Permission[] $directPermissions
 */
class User extends Authenticatable implements JWTSubject
{
    use HasRoles, HasCache;

    protected $guarded = [
        'password',
        'is_blocked',
    ];

    protected $hidden = [
        'password',
        'updated_at',
    ];

    protected $casts = [
        'is_blocked' => 'boolean',
    ];

    protected $appends = ['full_name'];

    public function username(): string
    {
        return 'email';
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->last_name} {$this->first_name}".($this->patronymic ? " {$this->patronymic}" : "");
    }

    /**
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function getAllPermissions(): \Illuminate\Support\Collection
    {
        return $this->getPermissionsViaRoles()->merge($this->permissions);
    }
}
