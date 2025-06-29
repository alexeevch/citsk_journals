<?php

namespace App\Http\Resources\Incident;

use App\Http\Resources\Attacker\AttackerResource;
use App\Http\Resources\IncidentStatus\IncidentStatusResource;
use App\Http\Resources\IncidentType\IncidentTypeResource;
use App\Http\Resources\Infrastructure\InfrastructureResource;
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
            'id'                     => $this->id,
            'attacker'               => new AttackerResource($this->attacker),
            'infrastructure'         => new InfrastructureResource($this->infrastructure),
            'type'                   => new IncidentTypeResource($this->type),
            'status'                 => new IncidentStatusResource($this->status),
            'description'            => $this->description,
            'detection_at'           => $this->detection_at,
            'group_notified_at'      => $this->group_notified_at,
            'supervisor_notified_at' => $this->supervisor_notified_at,
        ];
    }
}
