<?php

declare(strict_types=1);

namespace BrValidator\ValueObjects;

use BrValidator\Contracts\DocumentValidator;
use BrValidator\Contracts\DocumentValueObject;
use BrValidator\Documents\CNS as CNSValidator;
use BrValidator\Enums\DocumentType;
use BrValidator\Utils\DocumentHelper;

class CNSValueObject implements DocumentValueObject
{
    protected DocumentValidator $validator;

    public function __construct(protected readonly string $document)
    {
        $this->validator = new CNSValidator();

        if (!$this->validator->isValid($document)) {
            throw new \InvalidArgumentException('CNS inválido.');
        }
    }

    public function getDocumentType(): DocumentType
    {
        return DocumentType::CNS;
    }

    public function getUnmaskedValue(): string
    {
        return preg_replace('/\D/', '', $this->document);
    }

    public function getMaskedValue(): string
    {
        $numbers = $this->getUnmaskedValue();

        return DocumentHelper::mask($numbers, '### #### #### ####');
    }

    public function getObfuscatedValue(): string
    {
        return DocumentHelper::obfuscate($this->getUnmaskedValue(), 0, 4);
    }
}
