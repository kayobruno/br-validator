<?php

declare(strict_types=1);

namespace BrValidator;

use BrValidator\Enums\DocumentType;
use BrValidator\ValueObjects\CNPJValueObject;
use BrValidator\ValueObjects\CNSValueObject;
use BrValidator\ValueObjects\CPFValueObject;
use Throwable;

final class BrValidator
{
    public static function isValid(string $document, DocumentType $documentType): bool
    {
        try {
            match($documentType) {
                DocumentType::CPF => new CPFValueObject($document),
                DocumentType::CNPJ => new CNPJValueObject($document),
                DocumentType::CNS => new CNSValueObject($document),
            };

            return true;
        } catch (Throwable) {
            return false;
        }
    }
}
