<?php

declare(strict_types=1);

namespace Tests\ValueObjects;

use BrValidator\Enums\DocumentType;
use BrValidator\ValueObjects\CNPJValueObject;
use PHPUnit\Framework\TestCase;

final class CNPJValueObjectTest extends TestCase
{
    private ?CNPJValueObject $cnpj = null;

    protected function setUp(): void
    {
        $this->cnpj = new CNPJValueObject('11.222.333/0001-81');
    }

    public function testGetDocumentType(): void
    {
        $this->assertSame(DocumentType::CNPJ, $this->cnpj->getDocumentType());
    }

    public function testGetUnmaskedValue(): void
    {
        $this->assertSame('11222333000181', $this->cnpj->getUnmaskedValue());
    }

    public function testGetMaskedValue(): void
    {
        $this->assertSame('11.222.333/0001-81', $this->cnpj->getMaskedValue());
    }

    public function testGetObfuscatedValue(): void
    {
        $this->assertSame('11.********0001-81', $this->cnpj->getObfuscatedValue());
    }

    public function testThrowExceptionWhenDocumentIsInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('CNPJ inválido.');

        new CNPJValueObject('11222333000155');
    }
}
