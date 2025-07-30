<?php
/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ImmutableEnumPrinterTest.php
 * Project: Enums
 * Modified at: 30/07/2025, 11:57
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Tests\Enums\Unit\Printers;

use Generator;
use Iomywiab\Library\Enums\Printers\ImmutableEnumPrinter;
use Iomywiab\Library\Enums\Printers\PrintFormatEnum;
use Iomywiab\Library\Testing\DataTypes\IntEnum4Testing;
use Iomywiab\Library\Testing\DataTypes\StringEnum4Testing;
use Iomywiab\Tests\Enums\Fixtures\ExampleEnum;
use Iomywiab\Tests\Enums\Fixtures\ExampleIntBackedEnum;
use Iomywiab\Tests\Enums\Fixtures\ExampleStringBackedEnum;
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
     * @return Generator<non-empty-array<non-empty-string,UnitEnum|non-empty-string>>
     */
    public static function provideTestData(): Generator
    {
        yield ['enum' => PrintFormatEnum::BOTH, 'nameList' => 'NAME|VALUE|BOTH', 'valueList' => 'NAME|VALUE|BOTH', 'bothList' => 'NAME|VALUE|BOTH'];
        yield ['enum' => IntEnum4Testing::ONE, 'nameList' => 'ONE|TWO', 'valueList' => '1|2', 'bothList' => 'ONE(1)|TWO(2)'];
        yield ['enum' => StringEnum4Testing::ONE, 'nameList' => 'ONE|TWO', 'valueList' => 'One|Two', 'bothList' => 'ONE(One)|TWO(Two)'];
        yield ['enum' => ExampleEnum::EXAMPLE1, 'nameList' => 'EXAMPLE1|EXAMPLE2', 'valueList' => 'EXAMPLE1|EXAMPLE2', 'bothList' => 'EXAMPLE1|EXAMPLE2'];
        yield ['enum' => ExampleIntBackedEnum::ONE, 'nameList' => 'ONE|TWO', 'valueList' => '1|2', 'bothList' => 'ONE(1)|TWO(2)'];
        yield ['enum' => ExampleStringBackedEnum::EXAMPLE1, 'nameList' => 'EXAMPLE1|EXAMPLE2', 'valueList' => 'Ex1|Ex2', 'bothList' => 'EXAMPLE1(Ex1)|EXAMPLE2(Ex2)'];
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
        self::assertSame($nameList, (new ImmutableEnumPrinter(PrintFormatEnum::NAME))->toString($enum::cases()), 'name list');
        self::assertSame($valueList, (new ImmutableEnumPrinter(PrintFormatEnum::VALUE))->toString($enum::cases()), 'value list');
        self::assertSame($bothList, (new ImmutableEnumPrinter(PrintFormatEnum::BOTH))->toString($enum::cases()), 'both list');
    }

    /**
     * @return void
     */
    public function testToStringEmpty(): void
    {
        self::assertSame('', (new ImmutableEnumPrinter(PrintFormatEnum::NAME))->toString([]));
        self::assertSame('', (new ImmutableEnumPrinter(PrintFormatEnum::VALUE))->toString([]));
        self::assertSame('', (new ImmutableEnumPrinter(PrintFormatEnum::BOTH))->toString([]));
    }
}
