<?php

declare(strict_types=1);

namespace BrValidator\Utils;

final class DocumentHelper
{
    private function __construct()
    {
    }

    public static function mask(string $document, string $maskFormat): string
    {
        $numbers = preg_replace('/\D/', '', $document);
        $result = '';
        $index = 0;

        for ($i = 0; $i < strlen($maskFormat); $i++) {
            if ($maskFormat[$i] === '#') {
                if ($index < strlen($numbers)) {
                    $result .= $numbers[$index];
                    $index++;
                } else {
                    $result .= '';
                }
            } else {
                $result .= $maskFormat[$i];
            }
        }

        return $result;
    }

    public static function obfuscate(
        string $document,
        int $visibleStart = 0,
        int $visibleEnd = 4,
        string $mask = '*'
    ): string {
        $length = strlen($document);

        if ($length <= $visibleStart + $visibleEnd) {
            return $document;
        }

        $hiddenLength = $length - ($visibleStart + $visibleEnd);
        $hidden = str_repeat($mask, $hiddenLength);

        $start = substr($document, 0, $visibleStart);
        $end = substr($document, -$visibleEnd);

        return $start . $hidden . $end;
    }
}
