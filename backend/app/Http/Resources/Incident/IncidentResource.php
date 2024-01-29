<?php

namespace App\Http\Resources\Incident;

use App\Models\Incident;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Incident
 */
class IncidentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'attacker'              => $this->attacker,
            'infrastructure'        => $this->infrastructure,
            'type'                  => $this->type,
            'status'                => $this->status,
            'description'           => $this->description,
            'detection_time'        => $this->detection_time,
            'group_alert_time'      => $this->group_alert_time,
            'supervisor_alert_time' => $this->supervisor_alert_time,
        ];
    }
}
