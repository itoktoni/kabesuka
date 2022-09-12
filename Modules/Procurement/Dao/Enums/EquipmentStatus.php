<?php

namespace Modules\Procurement\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class EquipmentStatus extends Enum
{
    use StatusTrait;

    const Baik            =  'Baik';
    const Rusak            =  'Rusak';
    const Hilang            =  'Hilang';

    public static function colors()
    {
        return [
            self::Baik => ColorType::Warning,
            self::Rusak => ColorType::Primary,
            self::Hilang => ColorType::Danger,
        ];
    }

    public static function name()
    {
        return 'Equipment Status';
    }

    public static function getDescription($value): string
    {
        return parent::getDescription($value);
    }
}
