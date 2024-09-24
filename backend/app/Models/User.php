<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int    $id
 * @property bool   $is_blocked
 * @property string $login
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $patronymic
 * @property string $post
 * @property string $email
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 */
class User extends Authenticatable implements JWTSubject
{
    use HasRoles;

    protected $guarded = [
        'password',
        'login',
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

    /**
     * @return string
     */
    public function getFullName(): string
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
}
