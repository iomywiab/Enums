<?php

/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ExtendedBackedEnumInterface.php
 * Project: Enums
 * Modified at: 30/07/2025, 14:07
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Library\Enums\Traits;

use BackedEnum;
use Iomywiab\Library\Enums\Exceptions\UnknownEnumValueException;

interface ExtendedBackedEnumInterface extends BackedEnum, ExtendedEnumInterface
{
    /**
     * @param int|string $nameOrValue
     * @param bool|null $strict
     * @return static
     */
    public static function fromNameOrValue(int|string $nameOrValue, ?bool $strict = null): static;

    /**
     * @param int|string $value
     * @param bool|null $strict
     * @return static
     * @throws UnknownEnumValueException
     */
    public static function fromValue(int|string $value, ?bool $strict = null): static;

    /**
     * @return list<int|string>
     */
    public static function getAllValues(): array;

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValue(mixed $value): bool;

    /**
     * @param int|string $nameOrValue
     * @param bool|null $strict
     * @return static|null
     */
    public static function tryFromNameOrValue(int|string $nameOrValue, ?bool $strict = null): static|null;

    /**
     * @param int|string $value
     * @param bool|null $strict
     * @return static|null
     */
    public static function tryFromValue(int|string $value, ?bool $strict = null): static|null;
}
