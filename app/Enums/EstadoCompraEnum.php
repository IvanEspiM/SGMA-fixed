<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Activo()
 * @method static static Cerrado()
 * @method static static Anulado()
 */
final class EstadoCompraEnum extends Enum
{
    const ACTIVO = 1;
    const CERRADO = 2;
    const ANULADO = 3;

    public static function getNombre(int $value): string
    {
        return self::getKey($value);
    }
}
