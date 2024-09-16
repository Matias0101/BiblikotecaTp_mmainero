<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AuthorRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
//use Blueprint\Blueprint;
////use Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AuthorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AuthorCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Author::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/author');
        CRUD::setEntityNameStrings('autor', 'autores');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // set columns from db columns.
        // Columnas en español
        CRUD::addColumn(['name' => 'first_name', 'label' => 'Nombre']);
        CRUD::addColumn(['name' => 'last_name', 'label' => 'Apellido']);
        CRUD::addColumn(['name' => 'birthdate', 'label' => 'Fecha de Nacimiento']);
        CRUD::addColumn(['name' => 'country.name', 'label' => 'País']);

        CRUD::addColumn([
            'name' => 'creator.name',  // Relación con el creador
            'type' => 'text',
            'label' => 'Creado por',
        ]);
        // Mostrar quién actualizó el registro

        CRUD::addColumn([
            'name' => 'updater.name',  // Relación con el actualizador
            'type' => 'text',
            'label' => 'Actualizado por',
        ]);
        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }
    protected function setupShowOperation()
    {
        // Definir manualmente las columnas con sus etiquetas en español para la vista previa
        CRUD::addColumn(['name' => 'first_name', 'label' => 'Nombre']);
        CRUD::addColumn(['name' => 'last_name', 'label' => 'Apellido']);
        CRUD::addColumn(['name' => 'birthdate', 'label' => 'Fecha de Nacimiento']);
        CRUD::addColumn(['name' => 'country.name', 'label' => 'País']);

        // Mostrar quién creó el registro
        CRUD::addColumn([
            'name' => 'creator.name',
            'type' => 'text',
            'label' => 'Creado por',
        ]);

        // Mostrar quién actualizó el registro
        CRUD::addColumn([
            'name' => 'updater.name',
            'type' => 'text',
            'label' => 'Actualizado por',
        ]);
    }


    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(AuthorRequest::class);
        //CRUD::setFromDb(); // set fields from db columns.

        // Campo oculto para asignar el usuario que crea el registro
        // CRUD::addField([
        //     'name' => 'created_by',
        //     'type' => 'hidden',
        //     'value' => backpack_user()->id, // Asignar el usuario autenticado
        // Definir campos manualmente
        CRUD::field('first_name')->label('Nombre');
        CRUD::field('last_name')->label('Apellido');
        CRUD::field('birthdate')->label('Fecha de Nacimiento');

        CRUD::addField([
            'name' => 'birthdate',
            'label' => 'Fecha de Nacimiento',
            'type' => 'date',
            'attributes' => ['max' => now()->toDateString(),],
        ]);// Limitar la fecha máxima a hoy

        CRUD::field('country_id')->label('País');

        // Campo oculto para asignar el usuario autenticado que crea el registro
        CRUD::addField([
            'name' => 'created_by',
            'type' => 'hidden',
            'value' => backpack_user()->id,

        ]);
    }

    /**
     * Fields can be defined using the fluent syntax:
     * - CRUD::field('price')->type('number');
     */
    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
        CRUD::addField([
            'name' => 'updated_by',
            'type' => 'hidden',
            'value' => backpack_user()->id, // Asignar el usuario autenticado
        ]);
    }
    public function down(): void
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by']);
        });
    }




}

