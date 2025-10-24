<?php

declare(strict_types=1);

namespace BrValidator\Contracts;

use BrValidator\Enums\DocumentType;

interface DocumentValueObject
{
    public function getDocumentType(): DocumentType;

    public function getUnmaskedValue(): string;

    public function getMaskedValue(): string;

    public function getObfuscatedValue(): string;
}
