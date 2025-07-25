<?php

/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ExtendedBackedEnumTrait.php
 * Project: Enums
 * Modified at: 26/07/2025, 01:08
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Library\Enums\Traits;

use BackedEnum;
use Iomywiab\Library\Enums\Exceptions\UnknownEnumValueException;
use Throwable;
use function array_column;
use function in_array;
use function is_string;
use function strtolower;

/**
 * EnumTrait
 */
trait ExtendedBackedEnumTrait // implements ExtendedEnumInterface
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
    public static function getFirst(): BackedEnum
    {
        $cases = self::cases();
        $key = array_key_first($cases);

        return $cases[$key];
    }

    /**
     * @inheritDoc
     */
    public static function getLast(): BackedEnum
    {
        $cases = self::cases();
        $key = array_key_last($cases);

        return $cases[$key];
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
    public static function tryFromName(mixed $name, ?bool $strict = null): BackedEnum|null
    {
        try {

            return self::fromName($name, $strict);
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public static function fromName(mixed $name, ?bool $strict = null): BackedEnum
    {
        $strict = (true === $strict);
        $searchedValue = $strict ? strtolower($name) : $name;
        foreach (self::cases() as $case) {
            $caseName = $strict ? strtolower($case->name) : $case->name;
            if ($caseName === $searchedValue) {
                return $case;
            }
        }

        throw new UnknownEnumValueException(static::class, self::cases(), $name);
    }

    /**
     * @inheritDoc
     */
    public static function isValue(int|string $value): bool
    {
        return in_array($value, self::getAllValues(), true);
    }

    /**
     * @inheritDoc
     */
    public static function getAllValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * @inheritDoc
     */
    public static function tryFromValue(mixed $value, ?bool $strict = null): ?BackedEnum
    {
        try {
            return self::fromValue($value, $strict);
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public static function fromValue(int|string $value, ?bool $strict = null): BackedEnum
    {
        if ((false !== $strict) || !is_string($value)) {
            return static::from($value);
        }

        $searched = strtolower($value);
        foreach (self::cases() as $case) {
            if (!is_string($case->value)) {
                continue;
            }

            $found = strtolower($case->value);
            if ($found === $searched) {
                return $case;
            }
        }

        throw new UnknownEnumValueException(static::class, self::cases(), $value);
    }
}
