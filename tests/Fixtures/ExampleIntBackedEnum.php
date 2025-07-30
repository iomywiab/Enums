<?php
/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: ExampleIntBackedEnum.php
 * Project: Enums
 * Modified at: 30/07/2025, 11:34
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Tests\Enums\Fixtures;

use Iomywiab\Library\Enums\Traits\ExtendedBackedEnumInterface;
use Iomywiab\Library\Enums\Traits\ExtendedBackedEnumTrait;

/**
 * ExampleBackedEnum
 */
enum ExampleIntBackedEnum: int implements ExtendedBackedEnumInterface
{
    use ExtendedBackedEnumTrait;

    case ONE = 1;
    case TWO = 2;
}
