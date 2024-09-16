<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Author extends Model
{
    use CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'birthdate',
        'country_id',
        'created_by',  // Añadi estos campos al fillable
        'updated_by',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'birthdate' => 'date',
        'country_id' => 'integer',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    // Relación con el usuario que creó el registro
    public function creator(): BelongsTo
    {


        return $this->belongsTo(User::class, 'created_by');
    }



    // Relación con el usuario que actualizó el registro


    public function updater(): BelongsTo
    {


        return $this->belongsTo(User::class, 'updated_by');
    }

}
