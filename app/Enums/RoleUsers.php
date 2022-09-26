<?php

namespace App\Enums;

enum RoleUsers: string
{
    case ADMINISTRADOR = 'Admin';
    case ALUNO = 'Aluno';
    case PROFESSOR = 'Professor';
    case SECRETARIA = 'Secretaria';
}