<?php

/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ExtendedEnumTrait.php
 * Project: Enums
 * Modified at: 26/07/2025, 00:57
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Library\Enums\Traits;

use Iomywiab\Library\Enums\Exceptions\UnknownEnumValueException;
use Throwable;
use UnitEnum;
use function array_column;
use function array_key_first;
use function array_key_last;
use function in_array;
use function strtolower;

/**
 * EnumTrait
 */
trait ExtendedEnumTrait // implements ExtendedEnumInterface
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
    public static function getFirst(): UnitEnum
    {
        $cases = self::cases();
        $key = array_key_first($cases);

        return $cases[$key];
    }

    /**
     * @inheritDoc
     */
    public static function getLast(): UnitEnum
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
    public static function tryFromName(mixed $name, ?bool $strict = null): UnitEnum|null
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
    public static function fromName(mixed $name, ?bool $strict = null): UnitEnum
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
}
