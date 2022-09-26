<?php

namespace App\Enums;

enum StatusPagamento: int
{
    case EM_ABERTO = 1;
    case PAGO_COM_ATRASO = 2;
    case PAGO = 3;
    case ATRASADO = 4;
}