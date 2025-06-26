<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int    $id
 * @property string $name
 * @property string $contact_email
 * @property string $contact_phone
 * @mixin Eloquent
 */
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
