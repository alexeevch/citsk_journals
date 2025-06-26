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
    public array $type;
    public array $status;
    public ?string $description;
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
            'type'                   => ['required', 'array'],
            'status'                 => ['required', 'array'],
            'description'            => ['string'],
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
