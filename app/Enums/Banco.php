<?php

namespace App\Enums;

enum Banco: string
{
    case BANCO_DO_BRASIL = 'BBR';
    case SANTANDER = 'S';
    case BRADESCO = 'BR';
    case NEON = 'N';
    case PICPAY = 'P';
    case CAIXA_ECONOMICA = 'CE';
    case ITAU = 'I';
    case BANCO_PAN = 'BP';
    
}