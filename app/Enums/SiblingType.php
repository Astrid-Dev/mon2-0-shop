<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class SiblingType extends Enum implements LocalizedEnum
{
    const MAN = 'man';
    const WOMAN = 'woman';
    const KID = 'kid';
}
