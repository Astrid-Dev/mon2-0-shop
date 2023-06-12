<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class DimensionUnit extends Enum
{
    const SQUARE_METER = '㎡';
    const SQUARE_CENTIMETER = '㎠';
    const SQUARE_MILLIMETER = '㎟';
    const ARE = 'a';
    const HECTARE = 'ha';
    const SQUARE_KILOMETER = '㎢';

    const CUBE_METER = 'm³';
    const CUBE_CENTIMETER = '㎤';
    const LITER = 'l';
    const MILLILITER = 'ml';

    const METER = 'm';
    const CENTIMETER = 'cm';
    const MILLIMETER = 'mm';
    const KILOMETER = 'km';
}
