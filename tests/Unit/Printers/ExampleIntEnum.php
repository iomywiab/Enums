<?php
/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ExampleIntEnum.php
 * Project: Enums
 * Modified at: 25/07/2025, 15:29
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Tests\Enums\Unit\Printers;

enum ExampleIntEnum: int
{
    case ONE = 1;
    case TWO = 2;
}
