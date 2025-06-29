<?php

namespace App\Models;

use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int            $id
 * @property Attacker       $attacker
 * @property Infrastructure $infrastructure
 * @property IncidentType   $type
 * @property IncidentStatus $status
 * @property string         $description
 * @property DateTime       $detection_at
 * @property DateTime       $group_notified_at
 * @property DateTime       $supervisor_notified_at
 * @mixin Eloquent
 */
class Incident extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "attacker",
        "infrastructure",
        "type",
        "status",
        "description",
        "detection_at",
        "group_notified_at",
        "supervisor_notified_at",
    ];

    public function attacker(): BelongsTo
    {
        return $this->belongsTo(Attacker::class, "attacker_id");
    }

    public function infrastructure(): BelongsTo
    {
        return $this->belongsTo(Infrastructure::class, "infrastructure_id");
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(IncidentType::class, "type_id");
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(IncidentStatus::class, "status_id");
    }
}
