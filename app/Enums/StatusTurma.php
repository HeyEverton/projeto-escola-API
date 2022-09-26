<?php

namespace App\Enums;

enum StatusTurma: string
{
    case EM_ABERTO = 'A';
    case EM_ANDAMENTO = 'AN';
    case FECHADA = 'F';
}
