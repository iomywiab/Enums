<?php

/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ExtendedBackedEnumTrait.php
 * Project: Enums
 * Modified at: 30/07/2025, 14:06
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Library\Enums\Traits;

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
    use ExtendedEnumTrait;

    /**
     * @inheritDoc
     */
    public static function isValue(mixed $value): bool
    {
        if (is_string($value) || is_int($value)) {
            return in_array($value, self::getAllValues(), true);
        }

        return false;
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
    public static function tryFromValue(int|string $value, ?bool $strict = null): ?static
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
    public static function fromValue(int|string $value, ?bool $strict = null): static
    {
        if ((true === $strict) || !is_string($value)) {
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

    /**
     * @inherit
     */
    public static function fromNameOrValue(int|string $nameOrValue, ?bool $strict = null): static
    {
        return is_string($nameOrValue) && ('' !== $nameOrValue)
            ? self::tryFromName($nameOrValue, $strict) ?? self::fromValue($nameOrValue, $strict)
            : self::fromValue($nameOrValue, $strict);
    }

    /**
     * @inherit
     */
    public static function tryFromNameOrValue(int|string $nameOrValue, ?bool $strict = null): static|null
    {
        try {
            return self::fromNameOrValue($nameOrValue, $strict);
        } catch (Throwable) {
            return null;
        }
    }
}
