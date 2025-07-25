<?php
/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ExampleEnumTest.php
 * Project: Enums
 * Modified at: 26/07/2025, 01:14
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Tests\Enums\Unit\Traits;

use Iomywiab\Library\Enums\Exceptions\UnknownEnumValueException;
use Iomywiab\Library\Enums\Printers\ImmutableEnumPrinter;
use Iomywiab\Library\Enums\Traits\ExtendedEnumTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

/**
 * ExampleEnumTest
 */
#[CoversClass(ExtendedEnumTrait::class)]
#[UsesClass(UnknownEnumValueException::class)]
#[UsesClass(ImmutableEnumPrinter::class)]
class ExampleEnumTest extends TestCase
{
    use EnumTestCaseTrait;

    /**
     * @return void
     */
    public function testEnum(): void
    {
        $this->checkEnum(ExampleEnum::Example1, ['Example1', 'Example2']);
    }
}
