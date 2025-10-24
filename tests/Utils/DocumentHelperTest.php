<?php

declare(strict_types=1);

namespace Tests\Utils;

use BrValidator\Utils\DocumentHelper;
use PHPUnit\Framework\TestCase;

final class DocumentHelperTest extends TestCase
{
    /** @dataProvider maskProvider */
    public function testMask(string $document, string $maskFormat, string $expected): void
    {
        $this->assertSame($expected, DocumentHelper::mask($document, $maskFormat));
    }

    /**
     * @return array<int, array{document: string, mask: string, expected: string}>
     */
    public function maskProvider(): array
    {
        return [
            ['document' => '12345678909', 'mask' => '###.###.###-##', 'expected' => '123.456.789-09'],
            ['document' => '11222333000181', 'mask' => '##.###.###/####-##', 'expected' => '11.222.333/0001-81'],
            ['document' => '12345678', 'mask' => '##-##-##-##', 'expected' => '12-34-56-78'],
            ['document' => '123', 'mask' => '###.###', 'expected' => '123.'],
        ];
    }

    /** @dataProvider obfuscateProvider */
    public function testObfuscate(string $document, int $visibleStart, int $visibleEnd, string $mask, string $expected): void
    {
        $this->assertSame($expected, DocumentHelper::obfuscate($document, $visibleStart, $visibleEnd, $mask));
    }

    /**
     * @return array<int, array{document: string, visibleStart: int, visibleEnd: int, mask: string, expected: string}>
     */
    public function obfuscateProvider(): array
    {
        return [
            ['document' => '12345678909', 'visibleStart' => 0, 'visibleEnd' => 4, 'mask' => '*', 'expected' => '*******8909'],
            ['document' => '12345678909', 'visibleStart' => 3, 'visibleEnd' => 3, 'mask' => '*', 'expected' => '123*****909'],
            ['document' => '11222333000181', 'visibleStart' => 2, 'visibleEnd' => 4, 'mask' => '*', 'expected' => '11********0181'],
            ['document' => '1234', 'visibleStart' => 2, 'visibleEnd' => 2, 'mask' => '*', 'expected' => '1234'],
            ['document' => 'abcdef', 'visibleStart' => 1, 'visibleEnd' => 2, 'mask' => '#', 'expected' => 'a###ef'],
        ];
    }
}
