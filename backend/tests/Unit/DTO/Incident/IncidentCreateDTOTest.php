<?php

namespace DTO\Incident;

use App\DTO\Attacker\AttackerCreateDTO;
use App\DTO\Incident\IncidentCreateDTO;
use App\DTO\Infrastructure\InfrastructureCreateDTO;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class IncidentCreateDTOTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_be_created_with_valid_data(): void
    {
        $attacker = new AttackerCreateDTO([
            'country' => 'Китай',
            'ipv4'    => '10.129.2.2'
        ]);
        $infrastructure = new InfrastructureCreateDTO([
            'name'  => 'ГИС ГМП',
            'ipv4'  => '10.129.2.2',
            'owner' => 'ЦИТ СК',
        ]);
        $type = ["id" => 1];
        $status = ["id" => 2];
        $detectionTime = Carbon::now();
        $groupAlertTime = Carbon::now()->addHour();
        $supervisorAlertTime = Carbon::now()->addHour(2);

        $dto = new IncidentCreateDTO([
            'attacker'              => $attacker,
            'infrastructure'        => $infrastructure,
            'type'                  => $type,
            'status'                => $status,
            'description'           => 'Incident description',
            'detection_time'        => $detectionTime,
            'group_alert_time'      => $groupAlertTime,
            'supervisor_alert_time' => $supervisorAlertTime,
        ]);

        $this->assertInstanceOf(IncidentCreateDTO::class, $dto);
        $this->assertInstanceOf(AttackerCreateDTO::class, $dto->attacker);
        $this->assertInstanceOf(InfrastructureCreateDTO::class, $dto->infrastructure);
        $this->assertEquals($type, $dto->type);
        $this->assertEquals($status, $dto->status);
        $this->assertEquals('Incident description', $dto->description);
        $this->assertEquals($detectionTime, $dto->detection_time);
        $this->assertEquals($groupAlertTime, $dto->group_alert_time);
        $this->assertEquals($supervisorAlertTime, $dto->supervisor_alert_time);
    }


    /**
     * @test
     */
    public function it_casts_data_correctly(): void
    {
        $data = [
            'attacker'              => [
                'ipv4'    => '10.123.2.4',
                'country' => 'Россия'
            ],
            'infrastructure'        => [
                'name'  => 'ТОР КНД',
                'ipv4'  => '10.123.2.4',
                'owner' => 'Минпром ск'
            ],
            'type'                  => [
                'id' => 2,
            ],
            'status'                => [
                'id' => 12,
            ],
            'detection_time'        => '2023-03-08 10:00:00',
            'group_alert_time'      => '2023-03-08 11:00:00',
            'supervisor_alert_time' => '2023-03-08 12:00:00',
        ];

        $dto = new IncidentCreateDTO($data);

        $this->assertInstanceOf(AttackerCreateDTO::class, $dto->attacker);
        $this->assertInstanceOf(InfrastructureCreateDTO::class, $dto->infrastructure);
        $this->assertInstanceOf(Carbon::class, $dto->detection_time);
        $this->assertInstanceOf(Carbon::class, $dto->group_alert_time);
        $this->assertInstanceOf(Carbon::class, $dto->supervisor_alert_time);
    }

    /**
     * @test
     */
    public function it_validates_data(): void
    {
        $this->expectException(ValidationException::class);
        new IncidentCreateDTO([]);
    }
}
