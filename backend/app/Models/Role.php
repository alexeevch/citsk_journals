<?php

namespace App\Models;


use App\Traits\HasCache;

/**
 * @property int     $id
 * @property string  $name
 * @property string  $description
 * @property array   $permissions
 * @property boolean $deletable
 */
class Role extends \Spatie\Permission\Models\Role
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
