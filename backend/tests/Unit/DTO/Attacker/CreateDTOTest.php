<?php

namespace Tests\Unit\DTO\Attacker;

use App\DTO\Attacker\AttackerCreateDTO;
use Tests\TestCase;


class CreateDTOTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_be_created_with_valid_data(): void
    {
        $dataWithDescription = [
            'ipv4'        => '192.168.1.1',
            'description' => 'some description',
            'country'     => 'US',
        ];


        $dtoWithDescription = new AttackerCreateDTO($dataWithDescription);

        $this->assertEquals($dataWithDescription['ipv4'], $dtoWithDescription->ipv4);
        $this->assertEquals($dataWithDescription['country'], $dtoWithDescription->country);
        $this->assertEquals($dataWithDescription['description'], $dtoWithDescription->description);
    }

    /**
     * @test
     */
    public function it_can_be_created_with_valid_data_without_description(): void
    {
        $dataWithoutDescription = [
            'ipv4'    => '192.168.1.1',
            'country' => 'US',
        ];

        $dtoWithoutDescription = new AttackerCreateDTO($dataWithoutDescription);

        $this->assertEquals($dataWithoutDescription['ipv4'], $dtoWithoutDescription->ipv4);
        $this->assertEquals($dataWithoutDescription['country'], $dtoWithoutDescription->country);
    }

    /**
     * @test
     */
    public function it_fails_validation_with_invalid_ipv4(): void
    {
        $data = [
            'ipv4'        => 'invalid-ipv4',
            'description' => 'Test attacker',
            'country'     => 'US',
        ];

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        new AttackerCreateDTO($data);
    }

    /**
     * @test
     */
    public function it_fails_validation_with_missing_required_fields(): void
    {
        $data = [
            'description' => 'Test attacker',
            'country'     => 'US',
        ];

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        new AttackerCreateDTO($data);
    }
}
