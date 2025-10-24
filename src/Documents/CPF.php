<?php

declare(strict_types=1);

namespace BrValidator\Documents;

use BrValidator\Contracts\DocumentValidator;

final class CPF implements DocumentValidator
{
    public function isValid(string $document): bool
    {
        $cpf = preg_replace('/\D/', '', $document);

        if (strlen($cpf) !== 11) {
            return false;
        }

        if (preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        $base = substr($cpf, 0, 9);
        $dvInformado = substr($cpf, 9, 2);

        $dvCalculado = $this->calculateDv($base);

        return $dvInformado === $dvCalculado;
    }

    private function calculateDv(string $base): string
    {
        $dv1 = $this->calculateDigit($base, 10);
        $dv2 = $this->calculateDigit($base . $dv1, 11);

        return $dv1 . $dv2;
    }

    private function calculateDigit(string $value, int $weightStart): string
    {
        $sum = 0;
        $weight = $weightStart;

        foreach (str_split($value) as $digit) {
            $sum += (int)$digit * $weight--;
        }

        $rest = $sum % 11;

        return (string)(($rest < 2) ? 0 : 11 - $rest);
    }
}
