<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ImageType extends Enum
{
    const LOGO = 'logo';
    const ILLUSTRATION = 'illustration';
    const PROFILE = 'profile';
}
