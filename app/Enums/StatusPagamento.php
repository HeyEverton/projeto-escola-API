<?php

namespace App\Enums;

enum StatusPagamento: string
{
    case EM_ABERTO = 'Em aberto';
    case PAGO_COM_ATRASO = 'Pago com atraso';
    case PAGO = 'Pago';
    case ATRASADO = 'Atrasado';
}