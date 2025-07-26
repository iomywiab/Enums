<?php
/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ImmutableEnumPrinterTest.php
 * Project: Enums
 * Modified at: 26/07/2025, 01:51
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Tests\Enums\Unit\Printers;

use Iomywiab\Library\Enums\Printers\ImmutableEnumPrinter;
use Iomywiab\Library\Enums\Printers\PrintFormatEnum;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use UnitEnum;

/**
 *
 */
#[CoversClass(ImmutableEnumPrinter::class)]
class ImmutableEnumPrinterTest extends TestCase
{
    /**
     * @return non-empty-list<non-empty-list<UnitEnum|non-empty-string>>
     */
    public static function provideTestData(): array
    {
        return [
            [PrintFormatEnum::BOTH, 'NAME|VALUE|BOTH', 'NAME|VALUE|BOTH', 'NAME|VALUE|BOTH'],
            [ExampleIntEnum::ONE, 'ONE|TWO', '1|2', 'ONE(1)|TWO(2)'],
            [ExampleStringEnum::ONE, 'ONE|TWO', '1|2', 'ONE(1)|TWO(2)'],
        ];
    }

    /**
     * @param UnitEnum $enum
     * @param non-empty-string $nameList
     * @param non-empty-string $valueList
     * @param non-empty-string $bothList
     * @return void
     */
    #[DataProvider('provideTestData')]
    public function testEnumFormatter(UnitEnum $enum, string $nameList, string $valueList, string $bothList): void
    {
        self::assertSame($bothList, (new ImmutableEnumPrinter())->toString($enum::cases()));
        self::assertSame($nameList, (new ImmutableEnumPrinter(PrintFormatEnum::NAME))->toString($enum::cases()));
        self::assertSame($valueList, (new ImmutableEnumPrinter(PrintFormatEnum::VALUE))->toString($enum::cases()));
        self::assertSame($bothList, (new ImmutableEnumPrinter(PrintFormatEnum::BOTH))->toString($enum::cases()));
    }
}
