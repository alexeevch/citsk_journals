<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int    $id
 * @property string $ipv4
 * @property string $name
 * @property int    $owner_id
 * @mixin Eloquent
 */
class Infrastructure extends Model
{
    use HasFactory;

    protected $fillable = [
        "ipv4",
        "name",
        "owner_id",
    ];

    public function incident(): HasMany
    {
        return $this->hasMany(Incident::class, "infrastructure_id");
    }
}
