<?php

declare(strict_types=1);

namespace Tests\ValueObjects;

use BrValidator\Enums\DocumentType;
use BrValidator\ValueObjects\CNSValueObject;
use PHPUnit\Framework\TestCase;

final class CNSValueObjectTest extends TestCase
{
    private ?CNSValueObject $cns = null;

    protected function setUp(): void
    {
        $this->cns = new CNSValueObject('251922606580000');
    }

    public function testGetDocumentType(): void
    {
        $this->assertSame(DocumentType::CNS, $this->cns->getDocumentType());
    }

    public function testGetUnmaskedValue(): void
    {
        $this->assertSame('251922606580000', $this->cns->getUnmaskedValue());
    }

    public function testGetMaskedValue(): void
    {
        $this->assertSame('251 9226 0658 0000', $this->cns->getMaskedValue());
    }

    public function testGetObfuscatedValue(): void
    {
        $this->assertSame('***********0000', $this->cns->getObfuscatedValue());
    }

    public function testThrowExceptionWhenDocumentIsInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('CNS inválido.');

        new CNSValueObject('32434234');
    }
}
