<?php

namespace App\DTO\Incident;

use App\DTO\Attacker\AttackerCreateDTO;
use App\DTO\Infrastructure\InfrastructureCreateDTO;
use DateTime;
use WendellAdriel\ValidatedDTO\Casting\CarbonCast;
use WendellAdriel\ValidatedDTO\Casting\DTOCast;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class IncidentCreateDTO extends ValidatedDTO
{
    public AttackerCreateDTO $attacker;
    public InfrastructureCreateDTO $infrastructure;
    public array $type;
    public array $status;
    public ?string $description;
    public DateTime $detection_time;
    public DateTime $group_alert_time;
    public DateTime $supervisor_alert_time;

    protected function rules(): array
    {
        return [
            'attacker'              => ['required', 'array'],
            'infrastructure'        => ['required', 'array'],
            'type'                  => ['required', 'array'],
            'status'                => ['required', 'array'],
            'description'           => ['string'],
            'detection_time'        => ['required', 'date'],
            'group_alert_time'      => ['required', 'date'],
            'supervisor_alert_time' => ['required', 'date'],
        ];
    }

    protected function casts(): array
    {
        return [
            'attacker'              => new DTOCast(AttackerCreateDTO::class),
            'infrastructure'        => new DTOCast(InfrastructureCreateDTO::class),
            'detection_time'        => new CarbonCast(),
            'group_alert_time'      => new CarbonCast(),
            'supervisor_alert_time' => new CarbonCast(),
        ];
    }

    protected function defaults(): array
    {
        return [];
    }
}
