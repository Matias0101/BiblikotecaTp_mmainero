<?php

namespace App\Schemas\Blueprints;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

class CustomBlueprint extends Blueprint
{
    public function varChar($column, $length = null)
    {
        $length = $length ?: Builder::$defaultStringLength;
        return $this->addColumn(
            'string',//varchar
            $column,
            compact('length')
        );
    }
    // public function varChar($column, $length = null)
    // {
    //     return $this->string($column, $length);
    // }
}

// Sobrescribimos el método string para que siempre use varchar
// public function varChar($column, $length = null)
// {
//     $length = $length ?: Builder::$defaultStringLength;

//     return $this->addColumn('varChar', $column, compact('length'));
// }