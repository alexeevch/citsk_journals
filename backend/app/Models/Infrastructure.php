<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int    $id
 * @property string $ipv4
 * @property string $name
 * @property int    $owner_id
 * @property Owner  $owner
 * @mixin Eloquent
 */
class Infrastructure extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "ipv4",
        "name",
        "owner_id",
    ];

    public function incident(): HasMany
    {
        return $this->hasMany(Incident::class, "infrastructure_id");
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }
}
