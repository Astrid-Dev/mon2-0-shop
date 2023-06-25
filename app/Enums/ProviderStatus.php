<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class ProviderStatus extends Enum implements LocalizedEnum
{
    const PENDING = 'pending';
    const APPROVED = 'approved';
    const UNAPPROVED = 'unapproved';
}
