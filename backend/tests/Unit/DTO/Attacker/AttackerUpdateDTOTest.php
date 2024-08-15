<?php

namespace Tests\Unit\DTO\Attacker;

use App\DTO\Attacker\AttackerUpdateDTO;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class AttackerUpdateDTOTest extends TestCase
{
    public function testValidData(): void
    {
        $data = [
            'id'          => 1,
            'ipv4'        => '192.168.1.1',
            'description' => 'Test attacker',
            'country'     => 'US',
        ];

        $dto = new AttackerUpdateDTO($data);

        $this->assertEquals(1, $dto->id);
        $this->assertEquals('192.168.1.1', $dto->ipv4);
        $this->assertEquals('Test attacker', $dto->description);
        $this->assertEquals('US', $dto->country);
    }

    public function testInvalidIpv4(): void
    {
        $data = [
            'id'          => 1,
            'ipv4'        => '192.168.1.256',
            'description' => 'Test attacker',
            'country'     => 'US',
        ];

        $this->expectException(ValidationException::class);

        new AttackerUpdateDTO($data);
    }

    public function testMissingId(): void
    {
        $data = [
            'ipv4'        => '192.168.1.1',
            'description' => 'Test attacker',
            'country'     => 'US',
        ];

        $this->expectException(ValidationException::class);

        new AttackerUpdateDTO($data);
    }

    public function testInvalidId(): void
    {
        $data = [
            'id'          => 'abc',
            'ipv4'        => '192.168.1.1',
            'description' => 'Test attacker',
            'country'     => 'US',
        ];

        $this->expectException(ValidationException::class);

        new AttackerUpdateDTO($data);
    }

    public function testOptionalFields(): void
    {
        $data = [
            'id' => 1,
        ];

        $dto = new AttackerUpdateDTO($data);

        $this->assertEquals(1, $dto->id);
        $this->assertNull($dto->ipv4);
        $this->assertNull($dto->description);
        $this->assertNull($dto->country);
    }
}
