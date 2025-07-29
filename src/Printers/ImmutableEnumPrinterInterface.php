<?php

/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ImmutableEnumPrinterInterface.php
 * Project: Enums
 * Modified at: 29/07/2025, 21:29
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Library\Enums\Printers;

use UnitEnum;

/**
 *
 */
interface ImmutableEnumPrinterInterface
{
    /**
     * @param list<UnitEnum>|UnitEnum $enumCases
     * @return string
     */
    public function toString(array|UnitEnum $enumCases): string;
}
