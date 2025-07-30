<?php

/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ExtendedBackedEnumInterface.php
 * Project: Enums
 * Modified at: 30/07/2025, 12:18
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Library\Enums\Traits;

use BackedEnum;
use Iomywiab\Library\Enums\Exceptions\UnknownEnumValueException;

interface ExtendedBackedEnumInterface extends BackedEnum
{
    /**
     * @param non-empty-string $name
     * @param bool|null $strict
     * @return BackedEnum
     * @throws UnknownEnumValueException
     */
    public static function fromName(string $name, ?bool $strict = null): BackedEnum;

    /**
     * @param int|string $nameOrValue
     * @param bool|null $strict
     * @return BackedEnum
     */
    public static function fromNameOrValue(int|string $nameOrValue, ?bool $strict = null): BackedEnum;

    /**
     * @param int|string $value
     * @param bool|null $strict
     * @return BackedEnum
     * @throws UnknownEnumValueException
     */
    public static function fromValue(int|string $value, ?bool $strict = null): BackedEnum;

    /**
     * @return list<non-empty-string>
     */
    public static function getAllNames(): array;

    /**
     * @return list<int|string>
     */
    public static function getAllValues(): array;

    /**
     * @return BackedEnum
     */
    public static function getFirst(): BackedEnum;

    /**
     * @return BackedEnum
     */
    public static function getLast(): BackedEnum;

    /**
     * @param mixed $name
     * @return bool
     */
    public static function isName(mixed $name): bool;

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValue(mixed $value): bool;

    /**
     * @param non-empty-string $name
     * @param bool|null $strict
     * @return BackedEnum|null
     */
    public static function tryFromName(string $name, ?bool $strict = null): BackedEnum|null;

    /**
     * @param int|string $nameOrValue
     * @param bool|null $strict
     * @return BackedEnum|null
     */
    public static function tryFromNameOrValue(int|string $nameOrValue, ?bool $strict = null): BackedEnum|null;

    /**
     * @param int|string $value
     * @param bool|null $strict
     * @return BackedEnum|null
     */
    public static function tryFromValue(int|string $value, ?bool $strict = null): BackedEnum|null;
}
