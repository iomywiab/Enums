<?php

/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: EnumTestCaseTrait.php
 * Project: Enums
 * Modified at: 26/07/2025, 01:02
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Tests\Enums\Unit\Traits;

use InvalidArgumentException;
use Iomywiab\Library\Enums\Traits\ExtendedBackedEnumInterface;
use Iomywiab\Library\Enums\Traits\ExtendedEnumInterface;
use PHPUnit\Framework\TestCase;
use ValueError;
use function count;

/**
 * EnumTestCaseTrait
 */
trait EnumTestCaseTrait
{
    /**
     * @param ExtendedEnumInterface|ExtendedBackedEnumInterface $anyEnumItem
     * @param list<non-empty-string> $names
     * @return void
     * @noinspection PhpMultipleClassDeclarationsInspection
     */
    protected function checkEnum(ExtendedEnumInterface|ExtendedBackedEnumInterface $anyEnumItem, array $names): void
    {
        TestCase::assertEquals($names, $anyEnumItem::getAllNames());
        TestCase::assertEquals($names[0], $anyEnumItem::getFirst()->name);
        /** @noinspection OffsetOperationsInspection */
        TestCase::assertEquals($names[count($names) - 1], $anyEnumItem::getLast()->name);

        foreach ($names as $name) {
            $enum = $anyEnumItem::fromName($name);
            TestCase::assertSame($anyEnumItem::class, $enum::class);
            TestCase::assertSame($name, $enum->name);

            $enum = $anyEnumItem::fromName($name, false);
            TestCase::assertSame($anyEnumItem::class, $enum::class);
            TestCase::assertSame($name, $enum->name);

            $enum = $anyEnumItem::tryFromName($name);
            // @phpstan-ignore classConstant.nonObject
            TestCase::assertSame($anyEnumItem::class, $enum::class);
            // @phpstan-ignore property.nonObject
            TestCase::assertSame($name, $enum->name);

            $enum = $anyEnumItem::tryFromName($name, false);
            // @phpstan-ignore classConstant.nonObject
            TestCase::assertSame($anyEnumItem::class, $enum::class);
            // @phpstan-ignore property.nonObject
            TestCase::assertSame($name, $enum->name);

            TestCase::assertTrue($anyEnumItem::isName($name));
        }

        try {
            $anyEnumItem::fromName('jf8934fhw89zt59');
            TestCase::fail('Got: none. Expected: '.InvalidArgumentException::class);
        } catch (ValueError) {
            // no code. expected behavior
        }
        self::assertNull($anyEnumItem::tryFromName('jf8934fhw89zt59'));

        try {
            // @phpstan-ignore argument.type
            $anyEnumItem::fromName(123456);
            TestCase::fail('Got: none. Expected: '.InvalidArgumentException::class);
        } catch (ValueError) {
            // no code. expected behavior
        }
        // @phpstan-ignore argument.type
        self::assertNull($anyEnumItem::tryFromName(123456));
    }
}
