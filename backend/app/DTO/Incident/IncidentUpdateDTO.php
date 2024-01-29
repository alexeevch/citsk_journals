<?php

namespace App\DTO\Incident;

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
    public ?int $attacker_id;
    public ?int $infrastructure_id;
    public ?int $type_id;
    public ?int $status_id;
    public ?string $description;
    public ?DateTime $detection_time;
    public ?DateTime $group_alert_time;
    public ?DateTime $supervisor_alert_time;

    protected function rules(): array
    {
        return [
            'id'                    => ['required', 'integer'],
            'attacker'              => ['array'],
            'infrastructure'        => ['array'],
            'type'                  => ['array'],
            'status'                => ['array'],
            'description'           => ['string'],
            'detection_time'        => ['date'],
            'group_alert_time'      => ['date'],
            'supervisor_alert_time' => ['date'],
        ];
    }

    protected function casts(): array
    {
        return [
            'attacker'              => new DTOCast(AttackerUpdateDTO::class),
            'infrastructure'        => new DTOCast(InfrastructureUpdateDTO::class),
            'type'                  => new DTOCast(IncidentStatusUpdateDTO::class),
            'status'                => new DTOCast(IncidentStatusUpdateDTO::class),
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
