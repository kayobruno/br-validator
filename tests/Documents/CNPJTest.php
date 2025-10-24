<?php

declare(strict_types=1);

namespace Tests\Documents;

use BrValidator\Documents\CNPJ;
use PHPUnit\Framework\TestCase;

class CNPJTest extends TestCase
{
    private ?CNPJ $validator = null;

    protected function setUp(): void
    {
        $this->validator = new CNPJ();
    }

    public function testValidatesNumericCnpjCorrectly(): void
    {
        $validCnpj = '11222333000181';
        $this->assertTrue($this->validator->isValid($validCnpj));
    }

    public function testValidateCnpjWithMaskShouldReturnTrue(): void
    {
        $formatted = '11.222.333/0001-81';
        $this->assertTrue($this->validator->isValid($formatted));
    }

    public function testValidateCnpjShouldReturnFalse(): void
    {
        $invalid = '11222333000182';
        $this->assertFalse($this->validator->isValid($invalid));
    }

    public function testValidateCnpjWithIncorrectLengthShouldReturnFalse(): void
    {
        $tooShort = '1234567890123';
        $tooLong  = '123456789012345';

        $this->assertFalse($this->validator->isValid($tooShort));
        $this->assertFalse($this->validator->isValid($tooLong));
    }

    public function testValidateCnpjWithAlphanumericValueShouldReturnTrue(): void
    {
        $validAlphanumeric = '12ABC34501DE35';
        $this->assertTrue($this->validator->isValid($validAlphanumeric));
    }

    public function testValidateCnpjWithAlphanumericValueShouldReturnFalse(): void
    {
        $invalid = '12ABC34501DE12';
        $this->assertFalse($this->validator->isValid($invalid));
    }

    public function testValidateCnpjWithMaskedAlphanumericValueShouldReturnTrue(): void
    {
        $withSymbols = '12.AB-C3/4501D E35';
        $this->assertTrue($this->validator->isValid($withSymbols));
    }

    public function testValidateCnpjWithInvalidInputs(): void
    {
        $this->assertFalse($this->validator->isValid(''));
        $this->assertFalse($this->validator->isValid('ABCD'));
        $this->assertFalse($this->validator->isValid('123456'));
        $this->assertFalse($this->validator->isValid('##############'));
    }
}
