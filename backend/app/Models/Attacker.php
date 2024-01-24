<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
