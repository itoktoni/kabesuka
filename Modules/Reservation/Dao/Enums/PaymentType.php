<?php

namespace Modules\Reservation\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class PaymentType extends Enum
{
    use StatusTrait;

    const CASH = 'CASH';
    const DEBIT = 'DEBIG';
    const QRIS_ONLINE = 'QRIS_ONLINE';
    const QRIS_OFFLINE = 'QRIS_OFFLINE';

    public static function colors()
    {
        return [
            self::CASH => ColorType::Primary,
            self::DEBIT => ColorType::Warning,
            self::QRIS_ONLINE => ColorType::Info,
            self::QRIS_OFFLINE => ColorType::Success,
        ];
    }

    public static function name()
    {
        return 'Supplier Type';
    }
}
