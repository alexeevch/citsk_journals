<?php

namespace App\Models;


use App\Traits\HasCache;
use Spatie\Permission\Models\Role as BaseRole;

/**
 * @property int     $id
 * @property string  $name
 * @property string  $description
 * @property array   $permissions
 * @property boolean $deletable
 */
class Role extends BaseRole
{
    use HasCache;

    protected $hidden = [
        'guard_name',
        'created_at',
        'updated_at',
        'pivot',
        'deletable',
    ];

    protected $casts = [
        'deletable' => 'boolean',
    ];
}
