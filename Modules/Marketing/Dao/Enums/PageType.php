<?php

namespace Modules\Marketing\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class PageType extends Enum
{
    use StatusTrait;

    const Hide                     = 0;
    const Header                  =  1;
    const Footer                   =  2;

    public static function colors()
    {
        return [
            self::Hide => ColorType::Primary,
            self::Header => ColorType::Success,
            self::Footer => ColorType::Danger,
        ];
    }


    public static function name()
    {
        return 'Status Type';
    }
}
