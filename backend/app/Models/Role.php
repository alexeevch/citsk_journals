<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends \Spatie\Permission\Models\Role
{
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
