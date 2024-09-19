<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
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
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('Usuario', 'Usuarios');

        // Aquí verificamos si el usuario es 'admin' o 'read_only'
        if (backpack_user()->role == 'read_only') {
            $this->crud->denyAccess(['create', 'delete']);
            // Permite que solo pueda editar su propio perfil
            $this->crud->addClause('where', 'id', '=', backpack_user()->id);
        } else if (backpack_user()->role == 'admin') {
            $this->crud->allowAccess(['list', 'create', 'update', 'delete']);
        }
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
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UserRequest::class);
        //CRUD::setFromDb(); // set fields from db columns.
        CRUD::addField([
            'name' => 'name',
            'label' => 'Nombre Completo', // Cambiado a español
            'type' => 'text',
        ]);
        CRUD::addField([
            'name' => 'email',
            'label' => 'Correo Electrónico', // Cambiado a español
            'type' => 'email',
        ]);
        CRUD::addField([
            'name' => 'password',
            'label' => 'Contraseña', // Cambiado a español
            'type' => 'password',
        ]);
        CRUD::addField([
            'name' => 'password_confirmation',
            'label' => 'Confirmar Contraseña', // Cambiado a español
            'type' => 'password',
        ]);

        CRUD::addField([
            'name' => 'role',
            'label' => 'Rol', // Cambiado a español
            'type' => 'select_from_array',
            'options' => ['admin' => 'Admin', 'read_only' => 'Solo Lectura'],
            'allows_null' => false,
            'default' => 'read_only', // Valor por defecto
        ]);

        CRUD::addField([
            'name' => 'departament',
            'label' => 'Departamento', // Cambiado a español
            'type' => 'text',
        ]);
        CRUD::addField([
            'name' => 'internal',
            'label' => 'Interno', // Cambiado a español
            'type' => 'text',
        ]);
        CRUD::addField([
            'name' => 'cellphone',
            'label' => 'Teléfono Celular', // Cambiado a español
            'type' => 'text',
        ]);
        CRUD::addField([
            'name' => 'note',
            'label' => 'Nota', // Cambiado a español
            'type' => 'textarea',
        ]);
        CRUD::addField([
            'name' => 'alternate_email',
            'label' => 'Correo Electrónico Alternativo', // Cambiado a español
            'type' => 'email',
        ]);
        // Redirigir después de crear
        // $this->crud->setOperationSaveAction(function ($crud, $request, $redirectUrl) {
        //     // Redirige al formulario de creación para limpiar los campos
        //     return $crud->getSaveAction('new_item')->refresh();
        // });



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
        $this->setupCreateOperation();
        if (backpack_user()->role == 'read_only' && backpack_user()->id != CRUD::getCurrentEntry()->id) {
            abort(403, 'No tienes permiso para editar este perfil.');
        }

        $this->setupCreateOperation();

        $user = backpack_user();

        // Siempre utilizamos los mismos campos
        CRUD::addField([
            'name' => 'name',
            'label' => 'Nombre Completo',
            'type' => 'text',
        ]);

        // Si el usuario es read_only, mostramos el email como un campo de solo lectura
        if ($user->role == 'read_only' && $user->id == CRUD::getCurrentEntry()->id) {
            CRUD::addField([
                'name' => 'email',
                'label' => 'Correo Electrónico',
                'type' => 'view',  // Modo de solo visualización
                'value' => $user->email, // Valor actual del correo electrónico
            ]);
            CRUD::addField([
                'name' => 'role',
                'label' => 'Rol',
                'type' => 'view',  // Solo visualización
                //'options' => ['admin' => 'Admin', 'read_only' => 'Solo Lectura'],
                'value' => ucfirst($user->role),  // Mostramos el valor actual del rol
            ]);

        } else {
            // Si es admin, permitimos editar el email y el rol
            CRUD::addField([
                'name' => 'email',
                'label' => 'Correo Electrónico',
                'type' => 'email',  // Modo de edición normal
            ]);
            CRUD::addField([
                'name' => 'role',
                'label' => 'Rol',
                'type' => 'select_from_array',  // Modo seleccionable solo para admin
                'options' => ['admin' => 'Admin', 'read_only' => 'Solo Lectura'], // Asegúrate de que siempre se pase el array de opciones
                'allows_null' => false,
            ]);
        }

        // Otros campos
        CRUD::addField([
            'name' => 'password',
            'label' => 'Contraseña',
            'type' => 'password',
        ]);

        CRUD::addField([
            'name' => 'departament',
            'label' => 'Departamento',
            'type' => 'text',
        ]);
        CRUD::addField([
            'name' => 'internal',
            'label' => 'Interno',
            'type' => 'text',
        ]);
        CRUD::addField([
            'name' => 'cellphone',
            'label' => 'Teléfono Celular',
            'type' => 'text',
        ]);
        CRUD::addField([
            'name' => 'note',
            'label' => 'Nota',
            'type' => 'textarea',
        ]);
        CRUD::addField([
            'name' => 'alternate_email',
            'label' => 'Correo Electrónico Alternativo',
            'type' => 'email',
        ]);

        // Llamar a la validación correspondiente
        CRUD::setValidation(UserRequest::class);
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'role.required' => 'El rol es obligatorio.',
        ];
    }

}
