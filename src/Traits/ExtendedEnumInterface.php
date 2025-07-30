<?php

/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ExtendedEnumInterface.php
 * Project: Enums
 * Modified at: 30/07/2025, 14:06
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
     * @return static
     * @throws UnknownEnumValueException
     */
    public static function fromName(string $name, ?bool $strict = null): static;

    /**
     * @return list<non-empty-string>
     */
    public static function getAllNames(): array;

    /**
     * @return static
     */
    public static function getFirst(): static;

    /**
     * @return static
     */
    public static function getLast(): static;

    /**
     * @param mixed $name
     * @return bool
     */
    public static function isName(mixed $name): bool;

    /**
     * @param non-empty-string $name
     * @param bool|null $strict
     * @return static|null
     */
    public static function tryFromName(string $name, ?bool $strict = null): static|null;
}
