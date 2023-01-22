<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Cliente()
 * @method static static Proveedor() 
 */
final class TipoSujetoEnum extends Enum
{
    const CLIENTE = 1;
    const PROVEEDOR = 2;

    public static function getNombre(int $value): string
    {
        return self::getKey($value);
    }
}
