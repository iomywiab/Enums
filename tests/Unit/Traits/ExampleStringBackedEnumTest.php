<?php
/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ExampleStringBackedEnumTest.php
 * Project: Enums
 * Modified at: 29/07/2025, 10:43
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Tests\Enums\Unit\Traits;

use Iomywiab\Library\Enums\Exceptions\UnknownEnumValueException;
use Iomywiab\Library\Enums\Printers\ImmutableEnumPrinter;
use Iomywiab\Library\Enums\Traits\ExtendedBackedEnumTrait;
use Iomywiab\Library\Enums\Traits\ExtendedEnumSharedTrait;
use Iomywiab\Library\Enums\Traits\ExtendedEnumTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;
use TypeError;

/**
 * ExampleStringBackedEnumTest
 */
#[CoversClass(ExtendedBackedEnumTrait::class)]
#[UsesClass(UnknownEnumValueException::class)]
#[UsesClass(ExtendedEnumTrait::class)]
#[UsesClass(ImmutableEnumPrinter::class)]
#[UsesClass(ExtendedEnumSharedTrait::class)]
class ExampleStringBackedEnumTest extends TestCase
{
    use BackedEnumTestCaseTrait;

    /**
     * @return void
     */
    public function testEnum(): void
    {
        $this->checkBackedEnum(ExampleStringBackedEnum::Example1, ['Example1', 'Example2'], ['Ex1', 'Ex2']);
    }

    /**
     * @return void
     */
    public function testIntOnStringEnum(): void
    {
        $this->expectException(TypeError::class);
        ExampleStringBackedEnum::fromNameOrValue(1);
    }
}
