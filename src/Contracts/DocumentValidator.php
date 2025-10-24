<?php

declare(strict_types=1);

namespace BrValidator\Contracts;

interface DocumentValidator
{
    public function isValid(string $document): bool;
}
