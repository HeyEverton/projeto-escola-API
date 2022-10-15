<?php

namespace App\Enums;

enum Sexo: string
{
    case MASCULINO = 'M';
    case FEMININO = 'F';
    case PREFIRO_NÃO_INFORMAR = 'N';
}