<?php

namespace Modules\Reservation\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class PaymentType extends Enum
{
    use StatusTrait;

    const CASH = 'CASH';
    const DEBIT = 'DEBIT';
    const QRIS_ONLINE = 'QRIS_ONLINE';
    const QRIS_OFFLINE = 'QRIS_OFFLINE';
    const TRANSFER = 'TRANSFER';
    const APPS = 'APPS';

    public static function colors()
    {
        return [
            self::CASH => ColorType::Primary,
            self::DEBIT => ColorType::Warning,
            self::QRIS_ONLINE => ColorType::Info,
            self::QRIS_OFFLINE => ColorType::Success,
            self::TRANSFER => ColorType::Brown,
            self::APPS => ColorType::Grey,
        ];
    }

    public static function name()
    {
        return 'Payment Type';
    }
}
