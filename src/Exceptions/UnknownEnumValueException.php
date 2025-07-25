<?php

/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: UnknownEnumValueException.php
 * Project: Enums
 * Modified at: 26/07/2025, 00:35
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Library\Enums\Exceptions;

use Iomywiab\Library\Enums\Printers\ImmutableEnumPrinter;
use Iomywiab\Library\Enums\Printers\PrintFormatEnum;
use Throwable;
use UnitEnum;
use ValueError;
use function gettype;
use function is_scalar;

class UnknownEnumValueException extends ValueError implements EnumExceptionInterface
{
    /**
     * @param class-string $enumClassName
     * @param list<UnitEnum> $enumCases
     * @param mixed $value
     * @param PrintFormatEnum|null $format
     * @param Throwable|null $previous
     */
    public function __construct(
        string $enumClassName,
        array $enumCases,
        mixed $value,
        ?PrintFormatEnum $format = null,
        ?Throwable $previous = null
    ) {
        $printer = new ImmutableEnumPrinter($format);
        $allowed = $printer->toString($enumCases);

        try {
            $val = is_scalar($value) ? (string)$value : gettype($value);
        } catch (Throwable) {
            $val = 'n/a';
        }

        $message = "Unknown enum value. value=[$val] expected=[$allowed] enumClass=[$enumClassName]";

        parent::__construct($message, 0, $previous);
    }
}
