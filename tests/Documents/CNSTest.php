<?php

declare(strict_types=1);

namespace Tests\Documents;

use BrValidator\Documents\CNS;
use PHPUnit\Framework\TestCase;

class CNSTest extends TestCase
{
    private ?CNS $validator = null;

    protected function setUp(): void
    {
        $this->validator = new CNS();
    }

    public function testValidCnsWIthoutMaskShouldReturnTrue(): void
    {
        $this->assertTrue($this->validator->isValid('251922606580000'));
    }

    public function testValidCnsWithAnyMaskShouldReturnTrue(): void
    {
        $this->assertTrue($this->validator->isValid('2519.2260.6580.000'));
        $this->assertTrue($this->validator->isValid('2519 2260 6580 000'));
        $this->assertTrue($this->validator->isValid('2519-2260-6580-000'));
    }

    public function testInvalidCnsShouldReturnFalse(): void
    {
        $this->assertFalse($this->validator->isValid('11222333000100'));
    }

    public function testInvalidLengthShouldReturnFalse(): void
    {
        $this->assertFalse($this->validator->isValid('1234567890'));
        $this->assertFalse($this->validator->isValid('123456789012'));
    }

    public function testCnsWithAllSameDigitsShouldReturnFalse(): void
    {
        $this->assertFalse($this->validator->isValid('11111111111'));
        $this->assertFalse($this->validator->isValid('00000000000'));
        $this->assertFalse($this->validator->isValid('99999999999'));
    }

    public function testInvalidInputShouldReturnFalse(): void
    {
        $this->assertFalse($this->validator->isValid(''));
        $this->assertFalse($this->validator->isValid('abc'));
        $this->assertFalse($this->validator->isValid('123abc456-xx'));
    }
}
