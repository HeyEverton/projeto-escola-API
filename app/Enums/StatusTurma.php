<?php

namespace App\Enums;

enum StatusTurma: string
{
    case EM_ABERTO = 'Em aberto';
    case EM_ANDAMENTO = 'Em andamento';
    case FECHADA = 'Fechada';
}