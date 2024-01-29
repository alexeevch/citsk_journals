<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

//TODO: Make created_at timestamp
    public $timestamps = false;

    protected $fillable = [
        "ipv4",
        "description",
        "country",
    ];

    public function incident(): HasOne
    {
        return $this->hasOne(Incident::class, "attacker_id");
    }
}
