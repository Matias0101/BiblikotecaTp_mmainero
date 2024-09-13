<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BookRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BookCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BookCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Book::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/book');
        CRUD::setEntityNameStrings('libro', 'libros');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
        // Columnas en inglés en la base de datos, pero se muestran en español
        CRUD::column('type')->label('Tipo');
        CRUD::column('signature2')->label('signature 2');
        CRUD::column('title')->label('Título');
        CRUD::column('pages')->label('Paginas');
        CRUD::column('features')->label('Caracteristicas');
        CRUD::column('place_of_edition')->label('Lugar de edición');
        CRUD::column('edition_info')->label('Edición');
        CRUD::column('dimensions')->label('Dimensiones');
        CRUD::column('year')->label('Año');
        CRUD::column('isbn')->label('ISBN');
        CRUD::column('format')->label('Formato');
        CRUD::column('language')->label('Idioma');
        CRUD::column('note')->label('Nota');
        CRUD::column('inventory')->label('inventario');
        CRUD::column('origin')->label('Origen');
        CRUD::column('other_authors')->label('Otros autores');
        CRUD::column('image')->label('Imagen');
        CRUD::column('location')->label('Ubicación');
        CRUD::column('additional_info')->label('Contiene');
        CRUD::column('published_at')->label('Fecha de Publicación');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(BookRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        //$this->setupCreateOperation();
        // Campos en inglés en la base de datos, pero se muestran en español
        CRUD::field('title')->label('Título');
        CRUD::field('isbn')->label('ISBN');
        CRUD::field('published_at')->label('Fecha de Publicación');
    }
}
