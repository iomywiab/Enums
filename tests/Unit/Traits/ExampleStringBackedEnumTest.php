<?php
/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ExampleStringBackedEnumTest.php
 * Project: Enums
 * Modified at: 26/07/2025, 01:21
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Tests\Enums\Unit\Traits;

use Iomywiab\Library\Enums\Exceptions\UnknownEnumValueException;
use Iomywiab\Library\Enums\Printers\ImmutableEnumPrinter;
use Iomywiab\Library\Enums\Traits\ExtendedBackedEnumTrait;
use Iomywiab\Library\Enums\Traits\ExtendedEnumTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

/**
 * ExampleStringBackedEnumTest
 */
#[CoversClass(ExtendedBackedEnumTrait::class)]
#[UsesClass(UnknownEnumValueException::class)]
#[UsesClass(ExtendedEnumTrait::class)]
#[UsesClass(ImmutableEnumPrinter::class)]
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
}
