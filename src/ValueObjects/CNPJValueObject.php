<?php

declare(strict_types=1);

namespace BrValidator\ValueObjects;

use BrValidator\Documents\CNPJ as CNPJValidator;
use BrValidator\Enums\DocumentType;
use BrValidator\Utils\DocumentHelper;
use BrValidator\Contracts\DocumentValueObject;
use BrValidator\Contracts\DocumentValidator;

class CNPJValueObject implements DocumentValueObject
{
    protected DocumentValidator $validator;

    public function __construct(protected string $document)
    {
        $this->validator = new CNPJValidator();

        if (!$this->validator->isValid($document)) {
            throw new \InvalidArgumentException('CNPJ inválido.');
        }
    }

    public function getDocumentType(): DocumentType
    {
        return DocumentType::CNPJ;
    }

    public function getUnmaskedValue(): string
    {
        return strtoupper(preg_replace('/[^A-Z0-9]/', '', $this->document));
    }

    public function getMaskedValue(): string
    {
        return DocumentHelper::mask($this->document, '##.###.###/####-##');
    }

    public function getObfuscatedValue(): string
    {
        return DocumentHelper::obfuscate(document: $this->document, visibleStart: 3, visibleEnd: 7);
    }
}
