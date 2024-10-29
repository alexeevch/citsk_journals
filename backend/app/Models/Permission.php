<?php

namespace App\Models;


use App\Traits\HasCache;
use Spatie\Permission\Models\Permission as BasePermission;

/**
 * @property int     $id
 * @property string  $name
 * @property string  $description
 * @property boolean $deletable
 */
class Permission extends BasePermission
{
    use HasCache;

    protected $guarded = [
        'deletable',
    ];

    protected $hidden = [
        'guard_name',
        'created_at',
        'updated_at',
        'pivot',
    ];

    protected $casts = [
        'deletable' => 'boolean',
    ];
}
