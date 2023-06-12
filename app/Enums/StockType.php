<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class StockType extends Enum
{
    const IN_STOCK = 'in_stock';
    const OUT_OF_STOCK = 'out_of_stock';
    const PRE_ORDER = 'pre_order';
}
