<?php

namespace App\DTO\Incident;

use App\DTO\IncidentType\IncidentTypeUpdateDTO;
use DateTime;
use App\DTO\Attacker\AttackerUpdateDTO;
use App\DTO\IncidentStatus\IncidentStatusUpdateDTO;
use App\DTO\Infrastructure\InfrastructureUpdateDTO;
use WendellAdriel\ValidatedDTO\Casting\CarbonCast;
use WendellAdriel\ValidatedDTO\Casting\DTOCast;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class IncidentUpdateDTO extends ValidatedDTO
{
    public int $id;
    public ?int $attacker_id = null;
    public ?int $infrastructure_id = null;
    public ?int $type_id = null;
    public ?int $status_id = null;
    public ?string $description = null;
    public ?int $created_by = null;
    public ?DateTime $detection_at = null;
    public ?DateTime $group_notified_at = null;
    public ?DateTime $supervisor_notified_at = null;

    protected function rules(): array
    {
        return [
            'id'                     => ['required', 'integer'],
            'attacker_id'            => ['integer', 'exists:attackers,id'],
            'infrastructure_id'      => ['integer', 'exists:infrastructures,id'],
            'type_id'                => ['integer', 'exists:incident_types,id'],
            'status_id'              => ['integer', 'exists:incident_statuses,id'],
            'description'            => ['string'],
            'detection_at'           => ['date'],
            'group_notified_at'      => ['date'],
            'supervisor_notified_at' => ['date'],
            'created_by'             => ['integer', 'exists:users,id'],
        ];
    }

    protected function casts(): array
    {
        return [
            'detection_datetime'        => new CarbonCast(),
            'group_alert_datetime'      => new CarbonCast(),
            'supervisor_alert_datetime' => new CarbonCast(),
        ];
    }

    protected function defaults(): array
    {
        return [];
    }
}
