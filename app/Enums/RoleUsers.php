<?php

namespace App\Enums;

enum RoleUsers: string
{
    case ADMINISTRADOR = 'Administrador';
    case ALUNO = 'Aluno';
    case PROFESSOR = 'Professor';
    case SECRETARIA = 'Secretaria';
}