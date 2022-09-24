<?php

namespace App\Enums;

enum StatusTurma: string
{
    case EM_ABERTO = 'em aberto';

    case EM_ANDAMENTO = 'em andamento';

    case FECHADA = 'fechada';
}