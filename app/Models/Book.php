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
   // public function publisher(): BelongsTo
    //{
        //return $this->belongsTo(Publisher::class, 'publisher_id');
    //}
     // public function publisher(): BelongsTo
    // {
    //     return $this->belongsTo(Publisher::class, 'publisher_id');
    // }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_authors');
    }

    public function publishers()
    {
       // return $this->belongsTo(Publisher::class, 'publisher_id');
        return $this->belongsToMany(Publisher::class, 'book_publishers');
    }
    public function series()
    {
        return $this->belongsToMany(Serie::class, 'book_series');
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'book_subjects');
    }
    public function editions()
    {
        return $this->belongsToMany(Edition::class, 'book_editions');
    }



}


