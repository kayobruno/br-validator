<?php

declare(strict_types=1);

namespace BrValidator\Documents;

use BrValidator\Contracts\DocumentValidator;

final class CNPJ implements DocumentValidator
{
    public function isValid(string $document): bool
    {
        $cnpj = strtoupper(preg_replace('/[^A-Z0-9]/', '', $document));

        if (strlen($cnpj) !== 14) {
            return false;
        }

        $base = substr($cnpj, 0, 12);
        $dvInformado = substr($cnpj, 12, 2);

        $dvCalculado = $this->calculateDv($base);

        return $dvCalculado === $dvInformado;
    }

    private function calculateDv(string $base): string
    {
        $dv1 = $this->calculateDigit($base);
        $dv2 = $this->calculateDigit($base . $dv1);

        return $dv1 . $dv2;
    }

    private function calculateDigit(string $value): string
    {
        $values = [];

        foreach (str_split($value) as $char) {
            if (ctype_digit($char)) {
                $values[] = (int)$char;
            } else {
                $values[] = ord($char) - 48;
            }
        }

        $sum = 0;
        $weights = [2, 3, 4, 5, 6, 7, 8, 9];
        $weightIndex = 0;

        for ($i = count($values) - 1; $i >= 0; $i--) {
            $sum += $values[$i] * $weights[$weightIndex];
            $weightIndex = ($weightIndex + 1) % count($weights);
        }

        $rest = $sum % 11;

        return (string)(($rest == 0 || $rest == 1) ? 0 : 11 - $rest);
    }
}
