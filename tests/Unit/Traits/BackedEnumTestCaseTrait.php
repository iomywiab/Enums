<?php

/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: BackedEnumTestCaseTrait.php
 * Project: Enums
 * Modified at: 26/07/2025, 01:04
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Tests\Enums\Unit\Traits;

use Iomywiab\Library\Enums\Traits\ExtendedBackedEnumInterface;
use PHPUnit\Framework\TestCase;
use ValueError;
use function count;
use function is_int;
use function is_string;

/**
 * BackedEnumTestCaseTrait
 */
trait BackedEnumTestCaseTrait
{
    use EnumTestCaseTrait;

    /**
     * @param ExtendedBackedEnumInterface $anyEnumItem
     * @param list<non-empty-string> $names
     * @param list<mixed> $values
     * @return void
     * @noinspection PhpMultipleClassDeclarationsInspection
     */
    protected function checkBackedEnum(
        ExtendedBackedEnumInterface $anyEnumItem,
        array $names,
        array $values
    ): void {
        $this->checkEnum($anyEnumItem, $names);

        TestCase::assertEquals($values, $anyEnumItem::getAllValues());
        TestCase::assertEquals($values[0], $anyEnumItem::getFirst()->value);
        /** @noinspection OffsetOperationsInspection */
        TestCase::assertEquals($values[count($names) - 1], $anyEnumItem::getLast()->value);

        foreach ($names as $key => $name) {
            $enum = $anyEnumItem::fromName($name);
            TestCase::assertEquals($values[$key], $enum->value);

            $enum = $anyEnumItem::tryFromName($name);
            // @phpstan-ignore property.nonObject
            TestCase::assertEquals($values[$key], $enum->value);
        }

        foreach ($values as $key => $value) {
            // @phpstan-ignore argument.type
            $enum = $anyEnumItem::fromValue($value);
            TestCase::assertSame($value, $enum->value);
            /** @noinspection PhpArrayAccessCanBeReplacedWithForeachValueInspection */
            TestCase::assertEquals($values[$key], $enum->value);

            $enum = $anyEnumItem::fromValue($value, false);
            TestCase::assertSame($value, $enum->value);
            /** @noinspection PhpArrayAccessCanBeReplacedWithForeachValueInspection */
            // @phpstan-ignore argument.type
            TestCase::assertEquals($values[$key], $enum->value);

            // @phpstan-ignore argument.type
            TestCase::assertTrue($anyEnumItem::isValue($value));
        }

        TestCase::assertEquals($values, $anyEnumItem::getAllValues());

//        $isIntEnum = $anyEnumItem instanceof \IntBackedEnum;
        // @phpstan-ignore property.notFound
        $isIntEnum = is_int($anyEnumItem->value);
        if ($isIntEnum) {
            try {
                $anyEnumItem::fromValue(12345, true);
                TestCase::fail('Got: none. Expected: '.ValueError::class);
            } catch (ValueError) {
                // no code. expected behavior
            }
            self::assertNull($anyEnumItem::tryFromValue(12345, true));

            try {
                $anyEnumItem::fromValue(12345, false);
                TestCase::fail('Got: none. Expected: '.ValueError::class);
            } catch (ValueError) {
                // no code. expected behavior
            }
            self::assertNull($anyEnumItem::tryFromValue(12345, false));
        }

//        $isStringEnum = $anyEnumItem instanceof \StringBackedEnum;
        // @phpstan-ignore property.notFound
        $isStringEnum = is_string($anyEnumItem->value);
        if ($isStringEnum) {
            try {
                $anyEnumItem::fromValue('jf8934fhw89zt59', true);
                TestCase::fail('Got: none. Expected: '.ValueError::class);
            } catch (ValueError) {
                // no code. expected behavior
            }
            self::assertNull($anyEnumItem::tryFromValue('jf8934fhw89zt59', true));

            try {
                $anyEnumItem::fromValue('jf8934fhw89zt59', false);
                TestCase::fail('Got: none. Expected: '.ValueError::class);
            } catch (ValueError) {
                // no code. expected behavior
            }
            self::assertNull($anyEnumItem::tryFromValue('jf8934fhw89zt59', false));
        }

        if (!$isIntEnum && !$isStringEnum) {
            TestCase::fail('test incomplete');
        }
    }
}
