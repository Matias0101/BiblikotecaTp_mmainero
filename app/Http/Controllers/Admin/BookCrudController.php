<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BookRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

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

        // Cargar las relaciones necesarias
        CRUD::with(['country', 'authors', 'publishers', 'series', 'subjects', 'editions']);
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        // Conteo dinámico de libros en la base de datos
        $bookCount = \App\Models\Book::count();

        // Añadir un contenedor (row) y widgets dentro de él
        Widget::add()->to('before_content')->type('div')->class('row')->content([

            // Widget de progreso para mostrar conteo de libros
            Widget::make()
                ->type('progress')
                ->class('card border-0 text-white bg-success') // Color verde para libros
                ->progressClass('progress-bar')
                ->value($bookCount)
                ->description('Libros registrados')
                ->progress(100 * (int) $bookCount / 500) // Aquí 500 es el objetivo de libros, puedes cambiarlo
                ->hint(500 - $bookCount . ' libros más para alcanzar la meta.'),

            // Widget adicional (ejemplo) usando una tarjeta
            Widget::make(
                [
                    'type' => 'card',
                    'class' => 'card bg-info text-white',
                    'wrapper' => ['class' => 'col-sm-3 col-md-3'],
                    'content' => [
                        'header' => 'Total de Autores',
                        'body' => \App\Models\Author::count() . ' autores en total', // Muestra el conteo de autores
                    ]
                ]
            ),

            // Otro widget (ejemplo) mostrando el total de editoriales
            Widget::make(
                [
                    'type' => 'card',
                    'class' => 'card bg-warning text-white',
                    'wrapper' => ['class' => 'col-sm-3 col-md-3'],
                    'content' => [
                        'header' => 'Total de Editoriales',
                        'body' => \App\Models\Publisher::count() . ' editoriales en total', // Muestra el conteo de editoriales
                    ]
                ]
            ),
        ]);

        // Añadir CSS y JavaScript personalizados, si los necesitas
        Widget::add()->type('script')->stack('after_scripts')->content('https://code.jquery.com/ui/1.12.0/jquery-ui.min.js');
        Widget::add()->type('style')->stack('after_styles')->content('https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.0.0-beta.58/dist/themes/light.css');

        // Configuración de columnas y demás campos para listar libros, si no está configurado
        CRUD::column('title')->label('Título');
        CRUD::column('year')->label('Año de publicación');
        //CRUD::column('country_id')->label('País');
        // Aquí puedes agregar más columnas si es necesario
        //CRUD::setFromDb(); // set columns from db columns.

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
        // Configuración de columnas y demás campos para listar libros, si no está configurado
        CRUD::column('type')->label('Tipo');
        CRUD::column('title')->label('Título');
        CRUD::column('isbn')->label('ISBN');
        CRUD::column('country.name')->label('País');
        CRUD::column('authors')->label('Autores')->type('relationship');
        CRUD::column('publishers')->label('Editorial')->type('relationship');
        CRUD::column('series')->label('Series')->type('relationship');
        CRUD::column('subjects')->label('Temas')->type('relationship');
        CRUD::column('editions')->label('Ediciones')->type('relationship');

        // Columnas adicionales en inglés en la base de datos, mostradas en español
        CRUD::column('signature2')->label('Firma 2');
        CRUD::column('pages')->label('Páginas');
        CRUD::column('features')->label('Características');
        CRUD::column('place_of_edition')->label('Lugar de edición');
        CRUD::column('edition_info')->label('Edición');
        CRUD::column('dimensions')->label('Dimensiones');
        CRUD::column('year')->label('Año');
        CRUD::column('format')->label('Formato');
        CRUD::column('language')->label('Idioma');
        CRUD::column('inventory')->label('Inventario');
        CRUD::column('location')->label('Ubicación');
        CRUD::column('published_at')->label('Fecha de publicación');
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

        // Campo para País (Country) con relación
        CRUD::field('country_id')->label('País')->type('select')
            ->entity('country')
            ->model(\App\Models\Country::class)
            ->attribute('name');

        // Campo para Autores (Authors) con relación many-to-many
        CRUD::field('authors')->label('Autores')->type('relationship')
            ->entity('authors')
            ->model(\App\Models\Author::class)
            ->attribute('full_name') // Accesor en Author para mostrar el nombre completo
            ->pivot(true);

        // Campo para Editoriales (Publishers) con relación many-to-many
        CRUD::field('publishers')->label('Editorial')->type('relationship')
            ->entity('publishers')
            ->model(\App\Models\Publisher::class)
            ->attribute('name')
            ->pivot(true);

        //serie con relación many-to-many
        CRUD::field('series')->label('Serie')->type('relationship')
            ->entity('series')
            ->model(\App\Models\Serie::class)
            ->attribute('name')
            ->pivot(true);

        //temas subjet con relación many-to-many
        CRUD::field('subjects')->label('Temas')->type('relationship')
            ->entity('subjects')
            ->model(\App\Models\Subject::class)
            ->attribute('name')
            ->pivot(true);
        //editions subjet con relación many-to-many
        CRUD::field('editions')->label('Ediciones')->type('relationship')
            ->entity('editions')
            ->model(\App\Models\Edition::class)
            ->attribute('edition_number')
            ->pivot(true);



        //hasta aqui acomodar estos desplegables
        CRUD::field('signature2')->label('Firma 2')->type('text');
        CRUD::field('title')->label('Título')->type('text');
        CRUD::field('pages')->label('Páginas')->type('number');
        CRUD::field('features')->label('Características')->type('textarea');
        CRUD::field('place_of_edition')->label('Lugar de Edición')->type('text');
        CRUD::field('edition_info')->label('Edición')->type('text');
        CRUD::field('dimensions')->label('Dimensiones')->type('text');
        CRUD::field('year')->label('Año')->type('number');
        CRUD::field('isbn')->label('ISBN')->type('text');
        CRUD::field('format')->label('Formato')->type('text');
        CRUD::field('language')->label('Idioma')->type('text');
        CRUD::field('note')->label('Nota')->type('textarea');
        CRUD::field('inventory')->label('Inventario')->type('number');
        CRUD::field('origin')->label('Origen')->type('text');
        CRUD::field('other_authors')->label('Otros Autores')->type('text');
        CRUD::field('image')->label('Imagen')->type('upload')->upload(true)->disk('public'); // Aseguramos que usa el disco 'public';
        CRUD::field('location')->label('Ubicación')->type('text');
        CRUD::field('additional_info')->label('Información Adicional')->type('textarea');
        CRUD::field('published_at')->label('Fecha de Publicación')->type('date_picker');

    
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        // Usa la misma configuración de setupCreateOperation para el formulario de edición
        $this->setupCreateOperation();

    }
}
