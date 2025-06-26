<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Owner extends Model
{
    use SoftDeletes;

    protected $table = 'owners';

    protected $fillable = [
        'name',
        'contact_email',
        'contact_phone',
    ];

    protected $dates = [
        'deleted_at',
    ];
}
