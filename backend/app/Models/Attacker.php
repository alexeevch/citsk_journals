<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int      $id
 * @property string   $ipv4
 * @property string   $description
 * @property string   $country
 * @property Incident $incident
 * @mixin Eloquent
 */
class Attacker extends Model
{
    use HasFactory;

    protected $fillable = [
        "ipv4",
        "description",
        "country",
    ];

    public function incident(): HasMany
    {
        return $this->hasMany(Incident::class, "attacker_id");
    }
}
