<?php

declare(strict_types=1);

namespace Tests;

use BrValidator\BrValidator;
use BrValidator\Enums\DocumentType;
use PHPUnit\Framework\TestCase;

final class BrValidatorTest extends TestCase
{
    public function testValidCPF(): void
    {
        $validCpf = '12345678909';
        $this->assertTrue(BrValidator::isValid($validCpf, DocumentType::CPF));
    }

    public function testInvalidCPF(): void
    {
        $invalidCpf = '12345678900';
        $this->assertFalse(BrValidator::isValid($invalidCpf, DocumentType::CPF));
    }

    public function testValidCNPJ(): void
    {
        $validCnpj = '11222333000181';
        $this->assertTrue(BrValidator::isValid($validCnpj, DocumentType::CNPJ));
    }

    public function testValidCNPJAlfaNumeric(): void
    {
        $validCnpj = 'CT.5O5.QVR/0001-30';
        $this->assertTrue(BrValidator::isValid($validCnpj, DocumentType::CNPJ));
    }

    public function testInvalidCNPJ(): void
    {
        $invalidCnpj = '11222333000100';
        $this->assertFalse(BrValidator::isValid($invalidCnpj, DocumentType::CNPJ));
    }

    public function testValidCNS(): void
    {
        $validCns = '251922606580000';
        $this->assertTrue(BrValidator::isValid($validCns, DocumentType::CNS));
    }

    public function testInvalidCNS(): void
    {
        $invalidCNS = '11222333000100';
        $this->assertFalse(BrValidator::isValid($invalidCNS, DocumentType::CNS));
    }
}
