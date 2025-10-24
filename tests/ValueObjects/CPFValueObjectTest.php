<?php

declare(strict_types=1);

namespace Tests\ValueObjects;

use BrValidator\Enums\DocumentType;
use BrValidator\ValueObjects\CPFValueObject;
use PHPUnit\Framework\TestCase;

final class CPFValueObjectTest extends TestCase
{
    private ?CPFValueObject $cpf = null;

    protected function setUp(): void
    {
        $this->cpf = new CPFValueObject('123.456.789-09');
    }

    public function testGetDocumentType(): void
    {
        $this->assertSame(DocumentType::CPF, $this->cpf->getDocumentType());
    }

    public function testGetUnmaskedValue(): void
    {
        $this->assertSame('12345678909', $this->cpf->getUnmaskedValue());
    }

    public function testGetMaskedValue(): void
    {
        $this->assertSame('123.456.789-09', $this->cpf->getMaskedValue());
    }

    public function testGetObfuscatedValue(): void
    {
        $this->assertSame('**********9-09', $this->cpf->getObfuscatedValue());
    }

    public function testThrowExceptionWhenDocumentIsInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('CPF inválido.');

        new CPFValueObject('1234567890');
    }
}
