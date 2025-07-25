<?php

/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ExtendedEnumInterface.php
 * Project: Enums
 * Modified at: 26/07/2025, 01:12
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Library\Enums\Traits;

use Iomywiab\Library\Enums\Exceptions\UnknownEnumValueException;
use UnitEnum;

/**
 * ExtendedEnumInterface
 */
interface ExtendedEnumInterface extends UnitEnum
{
    /**
     * @param non-empty-string $name
     * @param bool|null $strict
     * @return UnitEnum
     * @throws UnknownEnumValueException
     */
    public static function fromName(string $name, ?bool $strict = null): UnitEnum;

    /**
     * @return list<non-empty-string>
     */
    public static function getAllNames(): array;

    /**
     * @return UnitEnum
     */
    public static function getFirst(): UnitEnum;

    /**
     * @return UnitEnum
     */
    public static function getLast(): UnitEnum;

    /**
     * @param non-empty-string $name
     * @return bool
     */
    public static function isName(string $name): bool;

    /**
     * @param non-empty-string $name
     * @param bool|null $strict
     * @return UnitEnum|null
     */
    public static function tryFromName(string $name, ?bool $strict = null): UnitEnum|null;
}
