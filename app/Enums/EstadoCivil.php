<?php

namespace App\Enums;

enum EstadoCivil: string
{
    case SOLTEIRO = 'S';
    case CASADO = 'C';
    case VIUVO = 'V';
    case SEPARADO_JUDICIALMENTE = 'SJ';
}