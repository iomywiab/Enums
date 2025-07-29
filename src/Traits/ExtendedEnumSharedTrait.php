<?php

/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ExtendedEnumSharedTrait.php
 * Project: Enums
 * Modified at: 29/07/2025, 07:45
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Library\Enums\Traits;

use BackedEnum;
use Iomywiab\Library\Enums\Exceptions\UnknownEnumValueException;
use Throwable;
use UnitEnum;
use function array_column;
use function array_key_first;
use function array_key_last;
use function in_array;
use function strtolower;

trait ExtendedEnumSharedTrait
{
    /**
     * @inheritDoc
     */
    public static function getAllNames(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * @inheritDoc
     */
    public static function isName(string $name): bool
    {
        $names = array_column(self::cases(), 'name');

        return in_array($name, $names, true);
    }

    /**
     * @inheritDoc
     */
    protected static function fromNameEnum(string $name, ?bool $strict = null): UnitEnum|BackedEnum
    {
        $strict = (true === $strict);
        $searchedValue = $strict ? $name : strtolower($name);
        foreach (self::cases() as $case) {
            $caseName = $strict ? $case->name : strtolower($case->name);
            if ($caseName === $searchedValue) {
                return $case;
            }
        }

        throw new UnknownEnumValueException(static::class, self::cases(), $name);
    }

    /**
     * @inheritDoc
     */
    protected static function getFirstEnum(): UnitEnum|BackedEnum
    {
        $cases = self::cases();
        $key = array_key_first($cases);

        return $cases[$key];
    }

    /**
     * @inheritDoc
     */
    protected static function getLastEnum(): UnitEnum|BackedEnum
    {
        $cases = self::cases();
        $key = array_key_last($cases);

        return $cases[$key];
    }

    /**
     * @inheritDoc
     */
    protected static function tryFromNameEnum(string $name, ?bool $strict = null): UnitEnum|BackedEnum|null
    {
        try {

            return self::fromName($name, $strict);
        } catch (Throwable) {
            return null;
        }
    }
}
