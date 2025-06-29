<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int      $id
 * @property string   $ipv4
 * @property string   $description
 * @property Incident $incident
 * @property Country  $country
 * @mixin Eloquent
 */
class Attacker extends Model
{
    use HasFactory;

    protected $fillable = [
        "ipv4",
        "description",
        "country_id",
    ];

    public function incident(): HasMany
    {
        return $this->hasMany(Incident::class, "attacker_id");
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, "country_id");
    }
}
