<?php

namespace Modules\Item\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class WaStatus extends Enum
{
    use StatusTrait;

    const Type                  =  null;
    const Process               =  1;
    const Done                   =  2;

    public static function colors()
    {
        return [
            self::Type => ColorType::Primary,
            self::Process => ColorType::Success,
            self::Done => ColorType::Danger,
        ];
    }

    public static function getDescription($value): string
    {
        if ($value === self::Type) {
            return '- Pilih Type -';
        }

        return parent::getDescription($value);
    }

    public static function name()
    {
        return 'Category Type';
    }
}
