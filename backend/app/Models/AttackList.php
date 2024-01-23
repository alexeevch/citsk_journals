<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AttackList extends Model
{
    use HasFactory;

    public function attack(): HasOne
    {
        return $this->hasOne(Attack::class, 'attack_id');
    }

    public function status(): HasOne
    {
        return $this->hasOne(AttackListStatus::class, "status_id");
    }
}
