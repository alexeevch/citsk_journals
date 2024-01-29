<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int    $id
 * @property string $ipv4
 * @property string $name
 * @property string $owner
 */
class Infrastructure extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "ipv4",
        "name",
        "owner",
    ];

    public function incident(): HasOne
    {
        return $this->hasOne(Incident::class, "attacked_id");
    }
}
