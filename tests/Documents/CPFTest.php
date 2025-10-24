<?php

declare(strict_types=1);

namespace Tests\Documents;

use BrValidator\Documents\CPF;
use PHPUnit\Framework\TestCase;

class CPFTest extends TestCase
{
    private ?CPF $validator = null;

    protected function setUp(): void
    {
        $this->validator = new CPF();
    }

    public function testValidateCpfShouldReturnTrue(): void
    {
        $this->assertTrue($this->validator->isValid('11144477735'));
    }

    public function testValidateCpfWithMaskShouldReturnTrue(): void
    {
        $this->assertTrue($this->validator->isValid('111.444.777-35'));
        $this->assertTrue($this->validator->isValid('111 444 777 35'));
        $this->assertTrue($this->validator->isValid('111-444-777.35'));
    }

    public function testValidateCpfShouldReturnFalse(): void
    {
        $this->assertFalse($this->validator->isValid('11144477736'));
    }

    public function testValidateCpfWithIncorrectLengthShouldReturnFalse(): void
    {
        $this->assertFalse($this->validator->isValid('1234567890'));
        $this->assertFalse($this->validator->isValid('123456789012'));
    }

    public function testValidateCpfWithSameDigitsShouldReturnFalse(): void
    {
        $this->assertFalse($this->validator->isValid('11111111111'));
        $this->assertFalse($this->validator->isValid('00000000000'));
        $this->assertFalse($this->validator->isValid('99999999999'));
    }

    public function testValidateCpfInvalidInputShouldReturnFalse(): void
    {
        $this->assertFalse($this->validator->isValid(''));
        $this->assertFalse($this->validator->isValid('abc'));
        $this->assertFalse($this->validator->isValid('123.abc.456-xx'));
    }
}
