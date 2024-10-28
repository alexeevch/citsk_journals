<?php

namespace App\Models;


class Permission extends \Spatie\Permission\Models\Permission
{
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
