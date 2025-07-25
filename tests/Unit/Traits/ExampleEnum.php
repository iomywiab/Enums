<?php
/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ExampleEnum.php
 * Project: Enums
 * Modified at: 25/07/2025, 15:29
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Tests\Enums\Unit\Traits;

use Iomywiab\Library\Enums\Traits\ExtendedEnumInterface;
use Iomywiab\Library\Enums\Traits\ExtendedEnumTrait;

/**
 * ExampleEnum
 */
enum ExampleEnum implements ExtendedEnumInterface
{
    use ExtendedEnumTrait;

    case Example1;
    case Example2;
}
