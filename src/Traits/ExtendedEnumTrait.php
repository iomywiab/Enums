<?php

/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ExtendedEnumTrait.php
 * Project: Enums
 * Modified at: 29/07/2025, 07:45
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Library\Enums\Traits;

use UnitEnum;

/**
 * EnumTrait
 */
trait ExtendedEnumTrait // implements ExtendedEnumInterface
{
    use ExtendedEnumSharedTrait;

    /**
     * @inheritDoc
     */
    public static function fromName(string $name, ?bool $strict = null): UnitEnum
    {
        return self::fromNameEnum($name, $strict);
    }

    /**
     * @inheritDoc
     */
    public static function getFirst(): UnitEnum
    {
        return self::getFirstEnum();
    }

    /**
     * @inheritDoc
     */
    public static function getLast(): UnitEnum
    {
        return self::getLastEnum();
    }

    /**
     * @inheritDoc
     */
    public static function tryFromName(string $name, ?bool $strict = null): UnitEnum|null
    {
        return self::tryFromNameEnum($name, $strict);
    }
}
