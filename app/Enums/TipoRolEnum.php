<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Administrador()
 * @method static static Gerente()
 * @method static static Mecanico()
 * @method static static Vendedor()
 */
final class TipoRolEnum extends Enum
{
    const VISITANTE =   0;
    const ADMINISTRADOR =   1;
    const GERENTE =   2;
    const MECANICO = 3;
    const VENDEDOR = 4;

    public static function getNombre(int $value): string
    {
        return self::getKey($value);
    }
}


/*
 * 
 * revisar su uso https://sampo.co.uk/blog/using-enums-in-laravel
 *  
 * https://github.com/BenSampo/laravel-enum/blob/v4.2.0/README.md
 * 
 */
