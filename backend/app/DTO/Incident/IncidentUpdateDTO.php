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
    public ?AttackerUpdateDTO $attacker = null;
    public ?InfrastructureUpdateDTO $infrastructure = null;
    public ?array $type = null;
    public ?array $status = null;
    public ?string $description = null;
    public ?DateTime $detection_time = null;
    public ?DateTime $group_alert_time = null;
    public ?DateTime $supervisor_alert_time = null;

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
            'type'                  => new DTOCast(IncidentTypeUpdateDTO::class),
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
