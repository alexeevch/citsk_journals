<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        "attacker_id",
        "infrastructure_id",
        "type_id",
        "status_id",
        "description",
        "detection_time",
        "group_alert_time",
        "supervisor_alert_time",
    ];

    protected $attributes = [
        'status_id' => 1, //TODO: Вынести магическое значение
    ];

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
