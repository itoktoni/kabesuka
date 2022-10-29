<?php

namespace Modules\Procurement\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class SalesStatus extends Enum
{
    use StatusTrait;

    const Create            =  1;
    const Table           =  2;
    const Paid           =  3;
    const Finish            =  4;
    const Cancel            =  5;

    public static function colors()
    {
        return [
            self::Create => ColorType::Warning,
            self::Table => ColorType::Primary,
            self::Paid => ColorType::Brown,
            self::Finish => ColorType::Success,
            self::Cancel => ColorType::Danger,
        ];
    }

    public static function name()
    {
        return 'Purchase Status';
    }

    public static function getDescription($value): string
    {
        return parent::getDescription($value);
    }
}
