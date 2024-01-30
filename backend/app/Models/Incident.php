<?php

namespace App\Models;

use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int            $id
 * @property Attacker       $attacker
 * @property Infrastructure $infrastructure
 * @property IncidentType   $type
 * @property IncidentStatus $status
 * @property string         $description
 * @property DateTime       $detection_time
 * @property DateTime       $group_alert_time
 * @property DateTime       $supervisor_alert_time
 * @mixin Eloquent
 */
class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        "attacker",
        "infrastructure",
        "type",
        "status",
        "description",
        "detection_time",
        "group_alert_time",
        "supervisor_alert_time",
    ];

    public function attacker(): BelongsTo
    {
        return $this->belongsTo(Attacker::class, "attacker_id");
    }

    public function infrastructure(): BelongsTo
    {
        return $this->belongsTo(Infrastructure::class, "infrastructure_id");
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
