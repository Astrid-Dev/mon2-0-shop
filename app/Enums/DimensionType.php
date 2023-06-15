<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class DimensionType extends Enum implements LocalizedEnum
{
    const LENGTH = 'length';
    const WIDTH = 'width';
    const HEIGHT = 'height';
    const DIAMETER = 'diameter';
    const DEPTH = 'depth';
    const THICKNESS = 'thickness';
    const WEIGHT = 'weight';
    const VOLUME = 'volume';
    const AREA = 'area';
    const CIRCUMFERENCE = 'circumference';
    const RADIUS = 'radius';
    const PERIMETER = 'perimeter';
    const DIAGONAL = 'diagonal';
}
