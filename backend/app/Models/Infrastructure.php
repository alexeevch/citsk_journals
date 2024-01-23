<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Infrastructure extends Model
{
    use HasFactory;

    public function incident(): HasOne
    {
        return $this->hasOne(Incident::class, "attacked_id");
    }
}
