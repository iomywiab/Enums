<?php

/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ImmutableEnumPrinter.php
 * Project: Enums
 * Modified at: 29/07/2025, 10:52
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Library\Enums\Printers;

use BackedEnum;
use UnitEnum;
use function assert;
use function is_array;

/**
 * @psalm-immutable
 */
class ImmutableEnumPrinter implements ImmutableEnumPrinterInterface
{
    private const DEFAULT_FORMAT = PrintFormatEnum::BOTH;
    private const DEFAULT_SEPARATOR = '|';
    private const NO_CASES = '';
    private readonly PrintFormatEnum $format;
    private readonly string $separator;

    /**
     * @param PrintFormatEnum|null $format
     * @param non-empty-string|null $separator
     */
    public function __construct(?PrintFormatEnum $format = null, ?string $separator = null)
    {
        $this->format = $format ?? self::DEFAULT_FORMAT;
        $this->separator = $separator ?? self::DEFAULT_SEPARATOR;
    }

    /**
     * @param list<UnitEnum>|UnitEnum $enumCases
     * @return non-empty-string
     */
    public function toString(array|UnitEnum $enumCases): string
    {
        $cases = is_array($enumCases) ? $enumCases : $enumCases::cases();

        return match ($this->format) {
            PrintFormatEnum::NAME => $this->toStringByName($cases),
            PrintFormatEnum::VALUE => $this->toStringByValue($cases),
            PrintFormatEnum::BOTH => $this->toStringByNameAndValue($cases),
        };
    }

    /**
     * @param array<array-key,UnitEnum> $cases
     * @return non-empty-string
     */
    private function toStringByName(array $cases): string
    {
        if ([] === $cases) {
            return self::NO_CASES;
        }

        $string = '';

        foreach ($cases as $case) {
            if ('' !== $string) {
                $string .= $this->separator;
            }
            $string .= $case->name;
        }

        assert('' !== $string);

        return $string;
    }

    /**
     * @param array<array-key,UnitEnum> $cases
     * @return non-empty-string
     */
    private function toStringByValue(array $cases): string
    {
        if ([] === $cases) {
            return self::NO_CASES;
        }

        $string = '';

        foreach ($cases as $case) {
            if ('' !== $string) {
                $string .= $this->separator;
            }
            $string .= (!($case instanceof BackedEnum)) ? $case->name : $case->value;
        }

        assert('' !== $string);

        return $string;
    }

    /**
     * @param array<array-key,UnitEnum> $cases
     * @return non-empty-string
     */
    private function toStringByNameAndValue(array $cases): string
    {
        if ([] === $cases) {
            return self::NO_CASES;
        }

        $string = '';

        foreach ($cases as $case) {
            if ('' !== $string) {
                $string .= $this->separator;
            }
            $string .= $case->name.(($case instanceof BackedEnum) ? '('.$case->value.')' : '');
        }

        assert('' !== $string);

        return $string;
    }
}
