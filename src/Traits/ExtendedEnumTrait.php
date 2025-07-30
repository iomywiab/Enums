<?php

/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ExtendedEnumTrait.php
 * Project: Enums
 * Modified at: 30/07/2025, 12:20
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Library\Enums\Traits;

use Iomywiab\Library\Enums\Exceptions\UnknownEnumValueException;
use Throwable;
use UnitEnum;
use function assert;

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
    public static function isName(mixed $name): bool
    {
        if (!is_string($name) || ('' === $name)) {
            return false;
        }

        $names = array_column(self::cases(), 'name');

        return in_array($name, $names, true);
    }

    /**
     * @inheritDoc
     */
    public static function fromName(string $name, ?bool $strict = null): UnitEnum
    {
        // @phpstan-ignore voku.NotIdentical
        assert('' !== $name);

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
    public static function tryFromName(string $name, ?bool $strict = null): UnitEnum|null
    {
        try {
            // @phpstan-ignore voku.NotIdentical
            assert('' !== $name);

            return self::fromName($name, $strict);
        } catch (Throwable) {
            return null;
        }
    }
}
