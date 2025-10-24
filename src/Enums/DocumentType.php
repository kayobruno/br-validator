<?php

declare(strict_types=1);

namespace BrValidator\Enums;

enum DocumentType: string
{
    case CPF = 'cpf';
    case CNPJ = 'cnpj';
    case CNS = 'cns';
}
