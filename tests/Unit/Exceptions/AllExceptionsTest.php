<?php
/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: AllExceptionsTest.php
 * Project: Enums
 * Modified at: 25/07/2025, 15:36
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Tests\Enums\Unit\Exceptions;

use Iomywiab\Library\Enums\Exceptions\UnknownEnumValueException;
use Iomywiab\Library\Enums\Printers\ImmutableEnumPrinter;
use Iomywiab\Library\Enums\Printers\PrintFormatEnum;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

/**
 *
 */
#[CoversClass(UnknownEnumValueException::class)]
#[UsesClass(ImmutableEnumPrinter::class)]
class AllExceptionsTest extends TestCase
{
    /**
     * @return void
     */
    public function testAllExceptions(): void
    {
        self::assertStringContainsString('Unknown enum value',
            (new UnknownEnumValueException(PrintFormatEnum::class, PrintFormatEnum::cases(), 1))->getMessage());
        self::assertStringContainsString('Unknown enum value',
            (new UnknownEnumValueException(PrintFormatEnum::class,
                PrintFormatEnum::cases(),
                STDOUT))->getMessage());
    }
}
