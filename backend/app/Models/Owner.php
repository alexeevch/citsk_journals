<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    use HasFactory;

    protected $table = 'owners';

    protected $fillable = [
        'name',
        'contact_email',
        'contact_phone',
    ];

    protected array $dates = [
        'deleted_at',
    ];

    public function infrastructures(): HasMany
    {
        return $this->hasMany(Infrastructure::class);
    }
}
