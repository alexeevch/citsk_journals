<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AttackListStatus extends Model
{
    use HasFactory;

    public function attackList(): HasMany
    {
        return $this->hasMany(AttackList::class, "attack_list_status_id");
    }
}
