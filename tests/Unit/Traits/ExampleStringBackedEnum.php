<?php
/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ExampleStringBackedEnum.php
 * Project: Enums
 * Modified at: 25/07/2025, 15:29
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Tests\Enums\Unit\Traits;

use Iomywiab\Library\Enums\Traits\ExtendedBackedEnumInterface;
use Iomywiab\Library\Enums\Traits\ExtendedBackedEnumTrait;

/**
 * ExampleBackedEnum
 */
enum ExampleStringBackedEnum: string implements ExtendedBackedEnumInterface
{
    use ExtendedBackedEnumTrait;

    case Example1 = 'Ex1';
    case Example2 = 'Ex2';
}
