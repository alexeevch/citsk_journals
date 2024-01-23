<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Attack extends Model
{
    use HasFactory;

    public function attacker(): HasOne
    {
        return $this->hasOne(Attacker::class, "attacker_id");
    }

    public function attacked(): HasOne
    {
        return $this->hasOne(Attacked::class, "attacked_id");
    }

    public function attackType(): HasOne
    {
        return $this->hasOne(AttackType::class, "attack_type_id");
    }
}
