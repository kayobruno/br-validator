<?php

declare(strict_types=1);

namespace BrValidator\ValueObjects;

use BrValidator\Contracts\DocumentValidator;
use BrValidator\Contracts\DocumentValueObject;
use BrValidator\Documents\CPF as CPFValidator;
use BrValidator\Enums\DocumentType;
use BrValidator\Utils\DocumentHelper;

class CPFValueObject implements DocumentValueObject
{
    protected DocumentValidator $validator;

    public function __construct(protected readonly string $document)
    {
        $this->validator = new CPFValidator();

        if (!$this->validator->isValid($document)) {
            throw new \InvalidArgumentException('CPF inválido.');
        }
    }

    public function getDocumentType(): DocumentType
    {
        return DocumentType::CPF;
    }

    public function getUnmaskedValue(): string
    {
        return preg_replace('/\D/', '', $this->document);
    }

    public function getMaskedValue(): string
    {
        return DocumentHelper::mask($this->document, '###.###.###-##');
    }

    public function getObfuscatedValue(): string
    {
        return DocumentHelper::obfuscate($this->document);
    }
}
