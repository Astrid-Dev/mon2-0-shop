<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class JerseyType extends Enum implements LocalizedEnum
{
    const SIMPLE = 'simple_jersey';
    const TEAM = 'team_jersey';
}
