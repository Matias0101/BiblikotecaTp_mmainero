<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'signature',
        'signature2',
        'title',
        'pages',
        'features',
        'place_of_edition',
        'edition_info',
        'dimensions',
        'year',
        'isbn',
        'format',
        'language',
        'note',
        'inventory',
        'origin',
        'other_authors',
        'publisher_id',
        'image',
        'location',
        'additional_info',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'year' => 'date',
    ];
     /**
     * Relación con el modelo Publisher
     */
    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }
}
