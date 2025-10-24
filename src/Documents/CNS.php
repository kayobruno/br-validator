<?php

declare(strict_types=1);

namespace BrValidator\Documents;

use BrValidator\Contracts\DocumentValidator;

final class CNS implements DocumentValidator
{
    public function isValid(string $document): bool
    {
        $cns = preg_replace('/\D/', '', $document);

        if (strlen($cns) !== 15) {
            return false;
        }

        $firstDigit = (int) $cns[0];

        if (!in_array($firstDigit, [1, 2, 7, 8, 9], true)) {
            return false;
        }

        $sum = 0;
        for ($i = 0; $i < 15; $i++) {
            $sum += ((15 - $i) * (int) $cns[$i]);
        }

        return $sum % 11 === 0;
    }
}
