<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Incident extends Model
{
    use HasFactory;

    public function attacker(): HasOne
    {
        return $this->hasOne(Attacker::class, "attacker_id");
    }

    public function infrastructure(): HasOne
    {
        return $this->hasOne(Infrastructure::class, "infrastructure_id");
    }

    public function incidentType(): BelongsTo
    {
        return $this->belongsTo(IncidentType::class, "type_id");
    }

    public function incidentStatus(): BelongsTo
    {
        return $this->belongsTo(IncidentStatus::class, "status_id");
    }
}
