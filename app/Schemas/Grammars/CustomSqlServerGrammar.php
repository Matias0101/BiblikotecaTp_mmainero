<?php

namespace App\Schemas\Grammars;

use Illuminate\Database\Schema\Grammars\SqlServerGrammar;
use Illuminate\Database\Schema\Grammars\SqlServerGrammar as BaseGrammar;
use Illuminate\Support\Fluent;

class CustomSqlServerGrammar extends SqlServerGrammar
{
    protected function typeString(Fluent $column)//typeVarchar
    {
        return "varchar({$column->length})";
    }
}