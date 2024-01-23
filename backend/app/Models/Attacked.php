<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Attacked extends Model
{
    use HasFactory;

    public function attack(): HasMany
    {
        return $this->hasMany(Attack::class, "attacked_id");
    }
}
