<?php

declare(strict_types=1);

namespace BrValidator\ValueObjects;

use BrValidator\Documents\CNS as CNSValidator;
use BrValidator\Enums\DocumentType;
use BrValidator\Utils\DocumentHelper;
use BrValidator\Contracts\DocumentValueObject;
use BrValidator\Contracts\DocumentValidator;

class CNSValueObject implements DocumentValueObject
{
    protected DocumentValidator $validator;

    public function __construct(protected string $document)
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
