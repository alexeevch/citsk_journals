<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attacker extends Model
{
    use HasFactory;

    public function attacks(): HasMany
    {
        return $this->hasMany(Attack::class, "attacker_id");
    }
}
