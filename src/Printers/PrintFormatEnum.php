<?php

/*
 * Copyright (c) 2022-2025 Iomywiab/PN, Hamburg, Germany. All rights reserved
 * File name: PrintFormatEnum.php
 * Project: Enums
 * Modified at: 25/07/2025, 15:34
 * Modified by: pnehls
 */

declare(strict_types=1);

namespace Iomywiab\Library\Enums\Printers;

use Iomywiab\Library\Enums\Traits\ExtendedEnumInterface;
use Iomywiab\Library\Enums\Traits\ExtendedEnumTrait;

/**
 *
 */
enum PrintFormatEnum implements ExtendedEnumInterface
{
    use ExtendedEnumTrait;

    case NAME;
    case VALUE;
    case BOTH;
}
