<?php

namespace App\Schemas\Grammars;

use Illuminate\Database\Schema\Grammars\MySqlGrammar;
use Illuminate\Support\Fluent;

class CustomMysqlGrammar extends MySqlGrammar
{
    protected function typeVarChar(Fluent $column)
    {
        // Usar varchar para ambos motores, forzando consistencia
        return "varchar({$column->length})";
    }
}

