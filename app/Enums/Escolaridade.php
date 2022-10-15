<?php

namespace App\Enums;

enum Escolaridade: string
{
    case MEDIO_COMPLETO = 'MC';
    case MEDIO_INCOMPLETO = 'MI';
    case FUNDAMENTAL_COMPLETO = 'FC';
    case FUNDAMENTAL_INCOMPLETO = 'FI';
    case SUPERIOR = 'S';
}