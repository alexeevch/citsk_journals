<?php

namespace App\DTO\Incident;

use App\DTO\Attacker\AttackerCreateDTO;
use DateTime;
use WendellAdriel\ValidatedDTO\Casting\CarbonCast;
use WendellAdriel\ValidatedDTO\Casting\DTOCast;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class IncidentCreateDTO extends ValidatedDTO
{
    public ?AttackerCreateDTO $attacker;
    public ?int $attacker_id;
    public ?int $infrastructure_id;
    public int $type_id;
    public int $status_id;
    public ?string $description;
    public ?int $created_by;
    public DateTime $detection_at;
    public DateTime $group_notified_at;
    public DateTime $supervisor_notified_at;

    protected function rules(): array
    {
        return [

            'detection_at'           => ['required', 'date'],
            'group_notified_at'      => ['required', 'date'],
            'supervisor_notified_at' => ['required', 'date'],
            'attacker_id'            => ['nullable', 'integer', 'exists:attackers, id'],
            'attacker'               => ['nullable', 'array'],
            'infrastructure_id'      => ['required', 'integer'],
            'type_id'                => ['required', 'integer', 'exists:incident_types,id'],
            'status_id'              => ['required', 'integer', 'exists:incident_statuses,id'],
            'description'            => ['string'],
            'created_by'             => ['required', 'integer', 'exists:users, id'],
        ];
    }

    protected function casts(): array
    {
        return [
            'attacker'               => new DTOCast(AttackerCreateDTO::class),
            'detection_at'           => new CarbonCast(),
            'group_notified_at'      => new CarbonCast(),
            'supervisor_notified_at' => new CarbonCast(),
        ];
    }

    protected function defaults(): array
    {
        return [];
    }
}
