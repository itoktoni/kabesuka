<?php

namespace Modules\Reservation\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class TypeBooking extends Enum
{
    use StatusTrait;

    const AYCE = 'AYCE';
    const ALA_CARTE = 'ALA_CARTE';

    public static function colors()
    {
        return [
            self::AYCE => ColorType::Primary,
            self::ALA_CARTE => ColorType::Warning,
        ];
    }

    public static function name()
    {
        return 'Supplier Type';
    }
}
