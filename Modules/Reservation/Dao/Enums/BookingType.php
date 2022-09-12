<?php

namespace Modules\Reservation\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class BookingType extends Enum
{
    use StatusTrait;

    const Cancel = 0;
    const Create = 1;
    const Booked = 2;
    const Process = 3;
    const Finish = 4;

    public static function colors()
    {
        return [
            self::Create => ColorType::Primary,
            self::Booked => ColorType::Success,
            self::Process => ColorType::Danger,
            self::Finish => ColorType::Danger,
            self::Cancel => ColorType::Danger,
        ];
    }

    public static function name()
    {
        return 'Supplier Type';
    }
}
